# Codex jako AI operacni vrstva pro skolni mini-laborator

Tento projekt je prakticka demonstrace pro prezentaci na 5-10 minut. Ukazuje Codex jako AI vrstvu nad projektem: prijme cil, precte soubory, naplanuje kroky, upravi vystupy, spusti kontrolu a vysvetli vysledek.

## Struktura

```text
ai-study-planner/
|- subjects.json      vstupni data o predmetech
|- generate_plan.js   hlavni nastroj, ktery vytvori studijni plan
|- validate_plan.js   kontrola, ze plan obsahuje vsechna temata
|- generate_plan.py   stejny generator ve verzi pro Python
|- validate_plan.py   stejna validace ve verzi pro Python
|- serve.js           maly lokalni webovy server
|- package.json       zkratky pro npm prikazy
|- RUN_COMMANDS.md    prenositelne prikazy pro domaci/skolni pocitac
|- plan.json          vygenerovany studijni plan
|- index.html         webove zobrazeni vysledku
|- style.css          vzhled stranky
|- explanation.md     vysvetleni rozhodnuti
`- README.md          navod a scenar prezentace
```

## Jak spustit demo

Nejjednodussi spusteni po stazeni projektu:

```powershell
npm.cmd run demo
```

Pak otevri:

```text
http://127.0.0.1:4173
```

Tento prikaz provede tri kroky: vytvori plan, zkontroluje plan a spusti lokalni web.

V PowerShellu na Windows je spolehlivejsi `npm.cmd`. V prikazovem radku `cmd` nebo na macOS/Linux pouzij `npm`.

Pokud `npm.cmd` nefunguje, pouzij prime prikazy:

```powershell
node .\generate_plan.js
node .\validate_plan.js
node .\serve.js
```

Podrobne prenositelne prikazy pro Windows, macOS, Linux, skolni pocitac a zmenu portu jsou v souboru `RUN_COMMANDS.md`.

## Jednotlive prikazy

Generator pokazde znovu vytvori `plan.json`, `index.html` a `explanation.md`:

```powershell
npm.cmd run generate
```

Validace overi, ze jsou vsechna temata ze vstupu ve vystupu:

```powershell
npm.cmd run validate
```

Server spusti web na adrese `http://127.0.0.1:4173`:

```powershell
npm.cmd run serve
```

Pokud chces pouzit Python misto Node.js, spust `python .\generate_plan.py`, potom `python .\validate_plan.py` a nakonec `python -m http.server 4173`.

## Co rict pri ukazce

Codex tady funguje jako AI operacni vrstva. Vstupem je cil uzivatele a soubor `subjects.json`. Codex dokaze projekt prohledat, pochopit data, upravit soubory, spustit overeni a vysvetlit vysledek.

## Prompt pro zive demo

```text
Podle subjects.json vytvor studijni plan na tri dny,
uloz ho do plan.json a vytvor jednoduchou stranku index.html,
ktera plan zobrazi.
```

## Rychla zmena pro zivou ukazku

Do `subjects.json` pridej dalsi predmet:

```json
{
  "subject": "Fyzika",
  "testDate": "2026-06-02",
  "difficulty": 4,
  "topics": ["rychlost", "sila", "energie"]
}
```

Potom znovu spust:

```powershell
npm.cmd run generate
npm.cmd run validate
```

Na tom je videt, ze nejde jen o odpoved v chatu. Zmenila se vstupni data, nastroj prepocital vystup a projekt ma novy overitelny stav.

## Tahak na slide

```text
Vstup:
- skolni data a cil uzivatele

AI operacni vrstva:
- planuje kroky
- cte a upravuje soubory
- pouziva nastroje
- vysvetluje vysledek

Vystup:
- funkcni mini aplikace
- dokumentace
- overitelny vysledek
```
