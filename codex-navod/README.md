# Návod pro spolužáky: funkce OpenAI Codexu

Webový návod splňující požadavek zadání: stránka jde otevřít v prohlížeči, zkopírovat, stáhnout jako HTML a vytisknout do PDF.

Obsah je zaměřený na použití Codex funkcí: stažení a přihlášení, Local, Worktree, Cloud, Git tools, terminál, in-app browser, modely, reasoning, speed, permissions, slash příkazy, Automations, Skills, Plugins, MCP, Local environments a programové režimy.

## Spuštění

```powershell
php -S 127.0.0.1:8020 -t W:\ops_codex_projekt\codex-navod
```

Pak otevři:

```text
http://127.0.0.1:8020
```

## Struktura

```text
codex-navod/
|- index.php
|- download.php
|- README.md
|- assets/
|  |- app.js
|  `- screenshots/
`- classes/
   |- ContentRepository.php
   |- Html.php
   |- Layout.php
   |- PageBuilder.php
   `- SectionRenderer.php
```

## Poznámka

Vzhled je postavený na Bootstrapu přes CDN. Pokud počítač nemá internet, obsah zůstane čitelný, ale nebude mít plné Bootstrap formátování.
