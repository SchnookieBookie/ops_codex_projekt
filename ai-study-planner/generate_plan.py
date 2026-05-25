from __future__ import annotations

import json
from datetime import date, datetime
from html import escape
from pathlib import Path


PROJECT_DIR = Path(__file__).parent
SUBJECTS_FILE = PROJECT_DIR / "subjects.json"
PLAN_FILE = PROJECT_DIR / "plan.json"
EXPLANATION_FILE = PROJECT_DIR / "explanation.md"
INDEX_FILE = PROJECT_DIR / "index.html"

DAYS = ["Pondeli", "Utery", "Streda"]
TODAY = date(2026, 5, 25)


def load_subjects() -> list[dict]:
    with SUBJECTS_FILE.open("r", encoding="utf-8") as file:
        return json.load(file)


def priority_score(subject: dict) -> int:
    test_date = datetime.strptime(subject["testDate"], "%Y-%m-%d").date()
    days_until_test = max((test_date - TODAY).days, 1)
    urgency = max(10 - days_until_test, 1)
    return subject["difficulty"] * 10 + urgency


def create_tasks(subjects: list[dict]) -> list[dict]:
    tasks = []
    for subject in subjects:
        for index, topic in enumerate(subject["topics"]):
            tasks.append(
                {
                    "subject": subject["subject"],
                    "topic": topic,
                    "testDate": subject["testDate"],
                    "difficulty": subject["difficulty"],
                    "priority": priority_score(subject) - index,
                }
            )
    return sorted(tasks, key=lambda task: task["priority"], reverse=True)


def create_plan(subjects: list[dict]) -> list[dict]:
    plan = [{"day": day, "tasks": []} for day in DAYS]
    tasks = create_tasks(subjects)

    for index, task in enumerate(tasks):
        day = plan[index % len(plan)]
        day["tasks"].append(
            {
                "label": f"{task['subject']}: {task['topic']}",
                "subject": task["subject"],
                "topic": task["topic"],
                "testDate": task["testDate"],
                "difficulty": task["difficulty"],
                "priority": task["priority"],
            }
        )

    return plan


def write_plan(plan: list[dict]) -> None:
    with PLAN_FILE.open("w", encoding="utf-8") as file:
        json.dump(plan, file, indent=2, ensure_ascii=False)
        file.write("\n")


def write_explanation(subjects: list[dict], plan: list[dict]) -> None:
    subject_count = len(subjects)
    task_count = sum(len(day["tasks"]) for day in plan)
    hardest = max(subjects, key=lambda item: item["difficulty"])

    text = f"""# Vysvetleni vysledku

Codex jako AI operacni vrstva provedl ukol ve ctyrech krocich:

1. Precetl vstupni data ze souboru `subjects.json`.
2. Prevedl predmety a temata na jednotlive studijni ukoly.
3. Seradil ukoly podle obtiznosti a bliziciho se testu.
4. Ulozil vysledek do `plan.json`, ktery zobrazuje stranka `index.html`.

## Shrnutí

- Pocet predmetu: {subject_count}
- Pocet naplanovanych ukolu: {task_count}
- Nejnarocnejsi predmet: {hardest["subject"]}
- Pouzity princip: vyssi obtiznost a blizsi termin maji vetsi prioritu

Tato ukazka demonstruje, ze Codex nevytvari jen textovou odpoved. Ridi maly proces nad projektem: cte data, planuje, zapisuje vystup a vysvetluje rozhodnuti.
"""

    EXPLANATION_FILE.write_text(text, encoding="utf-8")


def write_index(plan: list[dict]) -> None:
    cards = []
    for day in plan:
        task_items = []
        for task in day["tasks"]:
            task_items.append(
                f"""            <li>
              <span>{escape(task["label"])}</span>
              <small>test {escape(task["testDate"])} | obtiznost {task["difficulty"]}/5</small>
            </li>"""
            )

        cards.append(
            f"""        <article class="day-card">
          <h2>{escape(day["day"])}</h2>
          <ul>
{chr(10).join(task_items)}
          </ul>
        </article>"""
        )

    html = f"""<!doctype html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Study Planner</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <main class="app">
      <section class="intro">
        <p class="eyebrow">Codex jako AI operacni vrstva</p>
        <h1>AI Study Planner</h1>
        <p>
          Mini-laborator ukazuje, jak AI precte data, naplanuje praci,
          ulozi vysledek a zobrazi ho jako jednoduchou aplikaci.
        </p>
      </section>

      <section class="grid" id="plan" aria-label="Studijni plan">
{chr(10).join(cards)}
      </section>

      <section class="explanation">
        <h2>Co tato ukazka demonstruje</h2>
        <div class="steps">
          <article>
            <strong>1. Vstup</strong>
            <span>Data o predmetech jsou v souboru subjects.json.</span>
          </article>
          <article>
            <strong>2. Planovani</strong>
            <span>Skript seradi temata podle obtiznosti a terminu testu.</span>
          </article>
          <article>
            <strong>3. Vystup</strong>
            <span>Plan se ulozi do plan.json a zobrazi na teto strance.</span>
          </article>
        </div>
      </section>
    </main>
  </body>
</html>
"""

    INDEX_FILE.write_text(html, encoding="utf-8")


def main() -> None:
    subjects = load_subjects()
    plan = create_plan(subjects)
    write_plan(plan)
    write_index(plan)
    write_explanation(subjects, plan)
    print("Hotovo: vytvoren plan.json, index.html a explanation.md")


if __name__ == "__main__":
    main()
