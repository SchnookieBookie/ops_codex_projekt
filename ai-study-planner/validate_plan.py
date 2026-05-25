from __future__ import annotations

import json
from pathlib import Path


PROJECT_DIR = Path(__file__).parent
SUBJECTS_FILE = PROJECT_DIR / "subjects.json"
PLAN_FILE = PROJECT_DIR / "plan.json"


def load_json(path: Path):
    with path.open("r", encoding="utf-8") as file:
        return json.load(file)


def main() -> None:
    subjects = load_json(SUBJECTS_FILE)
    plan = load_json(PLAN_FILE)

    expected_topics = {
        (subject["subject"], topic)
        for subject in subjects
        for topic in subject["topics"]
    }
    planned_topics = {
        (task["subject"], task["topic"])
        for day in plan
        for task in day["tasks"]
    }

    missing = expected_topics - planned_topics
    extra = planned_topics - expected_topics

    if missing or extra:
        print("Validace selhala.")
        if missing:
            print("Chybi temata:", sorted(missing))
        if extra:
            print("Prebyvaji temata:", sorted(extra))
        raise SystemExit(1)

    print("Validace prosla: vsechna temata ze subjects.json jsou v plan.json.")


if __name__ == "__main__":
    main()
