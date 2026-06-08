# Codex jako AI operační vrstva pro školní mini-laboratoř

Tento projekt je praktická demonstrace pro prezentaci na 5-10 minut. Ukazuje Codex jako AI vrstvu nad projektem: přijme cíl, přečte soubory, naplánuje kroky, upraví výstupy, spustí kontrolu a vysvětlí výsledek.

## Struktura

```text
ai-study-planner/
|- subjects.json      vstupní data o předmětech
|- generate_plan.js   hlavní nástroj, který vytvoří studijní plán
|- validate_plan.js   kontrola dat i úplnosti plánu
|- generate_plan.py   stejný generátor ve verzi pro Python
|- validate_plan.py   stejná validace ve verzi pro Python
|- serve.js           malý lokální webový server
|- package.json       zkratky pro npm příkazy
|- RUN_COMMANDS.md    přenositelné příkazy pro domácí/školní počítač
|- plan.json          vygenerovaný studijní plán
|- index.html         webové zobrazení výsledku
|- style.css          vzhled stránky
|- explanation.md     vysvětlení rozhodnutí
`- README.md          návod a scénář prezentace
```

## Jak spustit demo

Nejjednodušší spuštění po stažení projektu:

```powershell
npm.cmd run demo
```

Pak otevři:

```text
http://127.0.0.1:4173
```

Tento příkaz provede tři kroky: vytvoří plán, zkontroluje plán a spustí lokální web.

V PowerShellu na Windows je spolehlivější `npm.cmd`. V příkazovém řádku `cmd` nebo na macOS/Linux použij `npm`.

Pokud `npm.cmd` nefunguje, použij přímé příkazy:

```powershell
node .\generate_plan.js
node .\validate_plan.js
node .\serve.js
```

Podrobné přenositelné příkazy pro Windows, macOS, Linux, školní počítač a změnu portu jsou v souboru `RUN_COMMANDS.md`.

## Jednotlivé příkazy

Generátor pokaždé znovu vytvoří `plan.json`, `index.html` a `explanation.md`:

```powershell
npm.cmd run generate
```

Validace ověří kvalitu vstupních dat i to, že jsou všechna témata ze vstupu ve výstupu:

```powershell
npm.cmd run validate
```

Server spustí web na adrese `http://127.0.0.1:4173`:

```powershell
npm.cmd run serve
```

Pokud chceš použít Python místo Node.js, spusť `python .\generate_plan.py`, potom `python .\validate_plan.py` a nakonec `python -m http.server 4173`.

## Co říct při ukázce

Codex tady funguje jako AI operační vrstva. Vstupem je cíl uživatele a soubor `subjects.json`. Codex dokáže projekt prohledat, pochopit data, upravit soubory, spustit ověření a vysvětlit výsledek.

Silný bod ukázky je validace: když někdo zadá nesmyslnou obtížnost, prázdné téma nebo špatné datum, kontrola chybu zastaví dřív, než se výsledek použije.

## Prompt pro živé demo

```text
Podle subjects.json vytvoř studijní plán na tři dny,
ulož ho do plan.json a vytvoř jednoduchou stránku index.html,
která plán zobrazí. Přidej i validaci vstupních dat.
```

## Rychlá změna pro živou ukázku

Do `subjects.json` přidej další předmět:

```json
{
  "subject": "Fyzika",
  "testDate": "2026-06-02",
  "difficulty": 4,
  "topics": ["rychlost", "síla", "energie"]
}
```

Potom znovu spusť:

```powershell
npm.cmd run generate
npm.cmd run validate
```

Na tom je vidět, že nejde jen o odpověď v chatu. Změnila se vstupní data, nástroj přepočítal výstup a projekt má nový ověřitelný stav.

## Tahák na slide

```text
Vstup:
- školní data a cíl uživatele

AI operační vrstva:
- plánuje kroky
- čte a upravuje soubory
- používá nástroje
- kontroluje chyby
- vysvětluje výsledek

Výstup:
- funkční mini aplikace
- dokumentace
- ověřitelný výsledek
```
