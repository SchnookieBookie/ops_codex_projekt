const fs = require("node:fs");
const path = require("node:path");

const projectDir = __dirname;
const subjects = JSON.parse(fs.readFileSync(path.join(projectDir, "subjects.json"), "utf8"));
const plan = JSON.parse(fs.readFileSync(path.join(projectDir, "plan.json"), "utf8"));

function addError(errors, message) {
  errors.push(`- ${message}`);
}

function validateSubjectData(subjectsToValidate) {
  const errors = [];

  if (!Array.isArray(subjectsToValidate) || subjectsToValidate.length === 0) {
    addError(errors, "subjects.json musí obsahovat neprázdné pole předmětů.");
    return errors;
  }

  subjectsToValidate.forEach((subject, index) => {
    const prefix = `Předmět #${index + 1}`;

    if (typeof subject.subject !== "string" || subject.subject.trim() === "") {
      addError(errors, `${prefix}: subject musí být neprázdný text.`);
    }

    if (typeof subject.testDate !== "string" || Number.isNaN(new Date(`${subject.testDate}T00:00:00`).getTime())) {
      addError(errors, `${prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.`);
    }

    if (!Number.isInteger(subject.difficulty) || subject.difficulty < 1 || subject.difficulty > 5) {
      addError(errors, `${prefix}: difficulty musí být celé číslo od 1 do 5.`);
    }

    if (!Array.isArray(subject.topics) || subject.topics.length === 0) {
      addError(errors, `${prefix}: topics musí obsahovat alespoň jedno téma.`);
      return;
    }

    subject.topics.forEach((topic, topicIndex) => {
      if (typeof topic !== "string" || topic.trim() === "") {
        addError(errors, `${prefix}: topics[${topicIndex}] musí být neprázdný text.`);
      }
    });
  });

  return errors;
}

function validatePlanCompleteness(subjectsToValidate, planToValidate) {
  const errors = [];
  const expectedTopics = new Set();
  const plannedTopics = new Set();

  for (const subject of subjectsToValidate) {
    for (const topic of subject.topics || []) {
      expectedTopics.add(`${subject.subject}::${topic}`);
    }
  }

  for (const day of planToValidate) {
    for (const task of day.tasks || []) {
      plannedTopics.add(`${task.subject}::${task.topic}`);
    }
  }

  const missing = [...expectedTopics].filter(topic => !plannedTopics.has(topic));
  const extra = [...plannedTopics].filter(topic => !expectedTopics.has(topic));

  if (missing.length) addError(errors, `Chybí témata: ${missing.join(", ")}`);
  if (extra.length) addError(errors, `Přebývají témata: ${extra.join(", ")}`);

  return errors;
}

const errors = [
  ...validateSubjectData(subjects),
  ...validatePlanCompleteness(subjects, plan)
];

if (errors.length) {
  console.log("Validace selhala.");
  console.log(errors.join("\n"));
  process.exit(1);
}

console.log("Validace prošla: data jsou v pořádku a všechna témata ze subjects.json jsou v plan.json.");
