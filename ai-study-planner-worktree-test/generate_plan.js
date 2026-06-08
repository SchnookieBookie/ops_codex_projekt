const fs = require("node:fs");
const path = require("node:path");

const projectDir = __dirname;
const subjectsFile = path.join(projectDir, "subjects.json");
const planFile = path.join(projectDir, "plan.json");
const explanationFile = path.join(projectDir, "explanation.md");
const indexFile = path.join(projectDir, "index.html");

const days = ["Pondělí", "Úterý", "Středa"];
const today = startOfDay(new Date());

function startOfDay(date) {
  return new Date(date.getFullYear(), date.getMonth(), date.getDate());
}

function readJson(file) {
  return JSON.parse(fs.readFileSync(file, "utf8"));
}

function assertText(value, label) {
  if (typeof value !== "string" || value.trim() === "") {
    throw new Error(`${label} musí být neprázdný text.`);
  }
}

function validateSubjects(subjects) {
  if (!Array.isArray(subjects) || subjects.length === 0) {
    throw new Error("subjects.json musí obsahovat neprázdné pole předmětů.");
  }

  subjects.forEach((subject, index) => {
    const prefix = `Předmět #${index + 1}`;
    assertText(subject.subject, `${prefix}: subject`);
    assertText(subject.testDate, `${prefix}: testDate`);

    const testDate = new Date(`${subject.testDate}T00:00:00`);
    if (Number.isNaN(testDate.getTime())) {
      throw new Error(`${prefix}: testDate musí být platné datum ve formátu YYYY-MM-DD.`);
    }

    if (!Number.isInteger(subject.difficulty) || subject.difficulty < 1 || subject.difficulty > 5) {
      throw new Error(`${prefix}: difficulty musí být celé číslo od 1 do 5.`);
    }

    if (!Array.isArray(subject.topics) || subject.topics.length === 0) {
      throw new Error(`${prefix}: topics musí obsahovat alespoň jedno téma.`);
    }

    subject.topics.forEach((topic, topicIndex) => {
      assertText(topic, `${prefix}: topics[${topicIndex}]`);
    });
  });
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
              <small>test ${escapeHtml(task.testDate)} | obtížnost ${task.difficulty}/5 | priorita ${task.priority}</small>
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
${cards}
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
`;

  fs.writeFileSync(indexFile, html, "utf8");
}

function writeExplanation(subjects, plan) {
  const subjectCount = subjects.length;
  const taskCount = plan.reduce((sum, day) => sum + day.tasks.length, 0);
  const hardest = subjects.reduce((best, subject) =>
    subject.difficulty > best.difficulty ? subject : best
  );

  const text = `# Vysvětlení výsledku

Codex jako AI operační vrstva provedl úkol v pěti krocích:

1. Přečetl vstupní data ze souboru \`subjects.json\`.
2. Ověřil, že data mají správný tvar, platná data testů a obtížnost 1-5.
3. Převedl předměty a témata na jednotlivé studijní úkoly.
4. Seřadil úkoly podle obtížnosti a blížícího se testu.
5. Uložil výsledek do \`plan.json\`, který zobrazuje stránka \`index.html\`.

## Shrnutí

- Počet předmětů: ${subjectCount}
- Počet naplánovaných úkolů: ${taskCount}
- Nejnáročnější předmět: ${hardest.subject}
- Použitý princip: vyšší obtížnost a bližší termín mají větší prioritu

Tato ukázka demonstruje, že Codex nevytváří jen textovou odpověď. Řídí malý proces nad projektem: čte data, plánuje, zapisuje výstup, kontroluje chyby a vysvětluje rozhodnutí.
`;

  fs.writeFileSync(explanationFile, text, "utf8");
}

const subjects = readJson(subjectsFile);
validateSubjects(subjects);
const plan = createPlan(subjects);

fs.writeFileSync(planFile, `${JSON.stringify(plan, null, 2)}\n`, "utf8");
writeIndex(plan);
writeExplanation(subjects, plan);

console.log("Hotovo: vytvořen plan.json, index.html a explanation.md");
