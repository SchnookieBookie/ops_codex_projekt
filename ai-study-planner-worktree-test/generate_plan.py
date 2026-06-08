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

DAYS = ["Pondělí", "Úterý", "Středa"]
TODAY = date.today()


def load_subjects() -> list[dict]:
    with SUBJECTS_FILE.open("r", encoding="utf-8") as file:
        return json.load(file)


def validate_subjects(subjects: list[dict]) -> None:
    if not isinstance(subjects, list) or not subjects:
        raise ValueError("subjects.json musí obsahovat neprázdné pole předmětů.")

    for index, subject in enumerate(subjects, start=1):
        prefix = f"Předmět #{index}"
        if not isinstance(subject.get("subject"), str) or not subject["subject"].strip():
            raise ValueError(f"{prefix}: subject musí být neprázdný text.")

        if not isinstance(subject.get("testDate"), str):
            raise ValueError(f"{prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.")
        try:
            datetime.strptime(subject["testDate"], "%Y-%m-%d").date()
        except ValueError as exc:
            raise ValueError(f"{prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.") from exc

        difficulty = subject.get("difficulty")
        if not isinstance(difficulty, int) or difficulty < 1 or difficulty > 5:
            raise ValueError(f"{prefix}: difficulty musí být celé číslo od 1 do 5.")

        topics = subject.get("topics")
        if not isinstance(topics, list) or not topics:
            raise ValueError(f"{prefix}: topics musí obsahovat alespoň jedno téma.")
        for topic_index, topic in enumerate(topics):
            if not isinstance(topic, str) or not topic.strip():
                raise ValueError(f"{prefix}: topics[{topic_index}] musí být neprázdný text.")


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

    text = f"""# Vysvětlení výsledku

Codex jako AI operační vrstva provedl úkol v pěti krocích:

1. Přečetl vstupní data ze souboru `subjects.json`.
2. Ověřil, že data mají správný tvar, platná data testů a obtížnost 1-5.
3. Převedl předměty a témata na jednotlivé studijní úkoly.
4. Seřadil úkoly podle obtížnosti a blížícího se testu.
5. Uložil výsledek do `plan.json`, který zobrazuje stránka `index.html`.

## Shrnutí

- Počet předmětů: {subject_count}
- Počet naplánovaných úkolů: {task_count}
- Nejnáročnější předmět: {hardest["subject"]}
- Použitý princip: vyšší obtížnost a bližší termín mají větší prioritu

Tato ukázka demonstruje, že Codex nevytváří jen textovou odpověď. Řídí malý proces nad projektem: čte data, plánuje, zapisuje výstup, kontroluje chyby a vysvětluje rozhodnutí.
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
              <small>test {escape(task["testDate"])} | obtížnost {task["difficulty"]}/5 | priorita {task["priority"]}</small>
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
        <p class="eyebrow">Codex jako AI operační vrstva</p>
        <h1>AI Study Planner</h1>
        <p>
          Mini-laboratoř ukazuje, jak AI přečte data, naplánuje práci,
          ověří výsledek a zobrazí ho jako jednoduchou aplikaci.
        </p>
      </section>

      <section class="summary" aria-label="Shrnutí pravidel plánování">
        <article>
          <strong>Vstup</strong>
          <span><code>subjects.json</code> obsahuje předměty, termíny testů, obtížnost a témata.</span>
        </article>
        <article>
          <strong>Priorita</strong>
          <span>Vyšší obtížnost a bližší test dostanou ve studijním plánu větší prioritu.</span>
        </article>
        <article>
          <strong>Kontrola</strong>
          <span>Validátor ověřuje úplnost plánu i kvalitu vstupních dat.</span>
        </article>
      </section>

      <section class="grid" id="plan" aria-label="Studijní plán">
{chr(10).join(cards)}
      </section>

      <section class="explanation">
        <h2>Co tato ukázka demonstruje</h2>
        <div class="steps">
          <article>
            <strong>1. Vstup</strong>
            <span>Data o předmětech jsou v souboru subjects.json.</span>
          </article>
          <article>
            <strong>2. Plánování</strong>
            <span>Skript seřadí témata podle obtížnosti a termínu testu.</span>
          </article>
          <article>
            <strong>3. Výstup</strong>
            <span>Plán se uloží do plan.json a zobrazí na této stránce.</span>
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
    validate_subjects(subjects)
    plan = create_plan(subjects)
    write_plan(plan)
    write_index(plan)
    write_explanation(subjects, plan)
    print("Hotovo: vytvořen plan.json, index.html a explanation.md")


if __name__ == "__main__":
    main()
