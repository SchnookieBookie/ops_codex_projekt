from __future__ import annotations

import json
from datetime import datetime
from pathlib import Path


PROJECT_DIR = Path(__file__).parent
SUBJECTS_FILE = PROJECT_DIR / "subjects.json"
PLAN_FILE = PROJECT_DIR / "plan.json"


def load_json(path: Path):
    with path.open("r", encoding="utf-8") as file:
        return json.load(file)


def validate_subject_data(subjects: list[dict]) -> list[str]:
    errors: list[str] = []
    if not isinstance(subjects, list) or not subjects:
        return ["subjects.json musí obsahovat neprázdné pole předmětů."]

    for index, subject in enumerate(subjects, start=1):
        prefix = f"Předmět #{index}"

        if not isinstance(subject.get("subject"), str) or not subject["subject"].strip():
            errors.append(f"{prefix}: subject musí být neprázdný text.")

        if not isinstance(subject.get("testDate"), str):
            errors.append(f"{prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.")
        else:
            try:
                datetime.strptime(subject["testDate"], "%Y-%m-%d")
            except ValueError:
                errors.append(f"{prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.")

        difficulty = subject.get("difficulty")
        if not isinstance(difficulty, int) or difficulty < 1 or difficulty > 5:
            errors.append(f"{prefix}: difficulty musí být celé číslo od 1 do 5.")

        topics = subject.get("topics")
        if not isinstance(topics, list) or not topics:
            errors.append(f"{prefix}: topics musí obsahovat alespoň jedno téma.")
            continue

        for topic_index, topic in enumerate(topics):
            if not isinstance(topic, str) or not topic.strip():
                errors.append(f"{prefix}: topics[{topic_index}] musí být neprázdný text.")

    return errors


def validate_plan_completeness(subjects: list[dict], plan: list[dict]) -> list[str]:
    expected_topics = {
        (subject["subject"], topic)
        for subject in subjects
        for topic in subject.get("topics", [])
    }
    planned_topics = {
        (task["subject"], task["topic"])
        for day in plan
        for task in day.get("tasks", [])
    }

    errors = []
    missing = expected_topics - planned_topics
    extra = planned_topics - expected_topics

    if missing:
        errors.append(f"Chybí témata: {sorted(missing)}")
    if extra:
        errors.append(f"Přebývají témata: {sorted(extra)}")

    return errors


def main() -> None:
    subjects = load_json(SUBJECTS_FILE)
    plan = load_json(PLAN_FILE)
    errors = validate_subject_data(subjects) + validate_plan_completeness(subjects, plan)

    if errors:
        print("Validace selhala.")
        for error in errors:
            print(f"- {error}")
        raise SystemExit(1)

    print("Validace prošla: data jsou v pořádku a všechna témata ze subjects.json jsou v plan.json.")


if __name__ == "__main__":
    main()
