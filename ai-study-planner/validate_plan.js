const fs = require("node:fs");
const path = require("node:path");

const projectDir = __dirname;
const subjects = JSON.parse(fs.readFileSync(path.join(projectDir, "subjects.json"), "utf8"));
const plan = JSON.parse(fs.readFileSync(path.join(projectDir, "plan.json"), "utf8"));

const expectedTopics = new Set();
const plannedTopics = new Set();

for (const subject of subjects) {
  for (const topic of subject.topics) {
    expectedTopics.add(`${subject.subject}::${topic}`);
  }
}

for (const day of plan) {
  for (const task of day.tasks) {
    plannedTopics.add(`${task.subject}::${task.topic}`);
  }
}

const missing = [...expectedTopics].filter(topic => !plannedTopics.has(topic));
const extra = [...plannedTopics].filter(topic => !expectedTopics.has(topic));

if (missing.length || extra.length) {
  console.log("Validace selhala.");
  if (missing.length) console.log("Chybi temata:", missing.join(", "));
  if (extra.length) console.log("Prebyvaji temata:", extra.join(", "));
  process.exit(1);
}

console.log("Validace prosla: vsechna temata ze subjects.json jsou v plan.json.");
