const fs = require("node:fs");
const path = require("node:path");

const projectDir = __dirname;
const subjectsFile = path.join(projectDir, "subjects.json");
const planFile = path.join(projectDir, "plan.json");
const explanationFile = path.join(projectDir, "explanation.md");
const indexFile = path.join(projectDir, "index.html");

const days = ["Pondeli", "Utery", "Streda"];
const today = new Date("2026-05-25T00:00:00");

function readJson(file) {
  return JSON.parse(fs.readFileSync(file, "utf8"));
}

function priorityScore(subject) {
  const testDate = new Date(`${subject.testDate}T00:00:00`);
  const daysUntilTest = Math.max(Math.round((testDate - today) / 86400000), 1);
  const urgency = Math.max(10 - daysUntilTest, 1);
  return subject.difficulty * 10 + urgency;
}

function createTasks(subjects) {
  const tasks = [];

  for (const subject of subjects) {
    subject.topics.forEach((topic, index) => {
      tasks.push({
        subject: subject.subject,
        topic,
        testDate: subject.testDate,
        difficulty: subject.difficulty,
        priority: priorityScore(subject) - index
      });
    });
  }

  return tasks.sort((a, b) => b.priority - a.priority);
}

function createPlan(subjects) {
  const plan = days.map(day => ({ day, tasks: [] }));
  const tasks = createTasks(subjects);

  tasks.forEach((task, index) => {
    plan[index % plan.length].tasks.push({
      label: `${task.subject}: ${task.topic}`,
      subject: task.subject,
      topic: task.topic,
      testDate: task.testDate,
      difficulty: task.difficulty,
      priority: task.priority
    });
  });

  return plan;
}

function escapeHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;");
}

function writeIndex(plan) {
  const cards = plan.map(day => {
    const tasks = day.tasks.map(task => `            <li>
              <span>${escapeHtml(task.label)}</span>
              <small>test ${escapeHtml(task.testDate)} | obtiznost ${task.difficulty}/5</small>
            </li>`).join("\n");

    return `        <article class="day-card">
          <h2>${escapeHtml(day.day)}</h2>
          <ul>
${tasks}
          </ul>
        </article>`;
  }).join("\n");

  const html = `<!doctype html>
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
${cards}
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
`;

  fs.writeFileSync(indexFile, html, "utf8");
}

function writeExplanation(subjects, plan) {
  const subjectCount = subjects.length;
  const taskCount = plan.reduce((sum, day) => sum + day.tasks.length, 0);
  const hardest = subjects.reduce((best, subject) =>
    subject.difficulty > best.difficulty ? subject : best
  );

  const text = `# Vysvetleni vysledku

Codex jako AI operacni vrstva provedl ukol ve ctyrech krocich:

1. Precetl vstupni data ze souboru \`subjects.json\`.
2. Prevedl predmety a temata na jednotlive studijni ukoly.
3. Seradil ukoly podle obtiznosti a bliziciho se testu.
4. Ulozil vysledek do \`plan.json\`, ktery zobrazuje stranka \`index.html\`.

## Shrnutí

- Pocet predmetu: ${subjectCount}
- Pocet naplanovanych ukolu: ${taskCount}
- Nejnarocnejsi predmet: ${hardest.subject}
- Pouzity princip: vyssi obtiznost a blizsi termin maji vetsi prioritu

Tato ukazka demonstruje, ze Codex nevytvari jen textovou odpoved. Ridi maly proces nad projektem: cte data, planuje, zapisuje vystup a vysvetluje rozhodnuti.
`;

  fs.writeFileSync(explanationFile, text, "utf8");
}

const subjects = readJson(subjectsFile);
const plan = createPlan(subjects);

fs.writeFileSync(planFile, `${JSON.stringify(plan, null, 2)}\n`, "utf8");
writeIndex(plan);
writeExplanation(subjects, plan);

console.log("Hotovo: vytvoren plan.json, index.html a explanation.md");
