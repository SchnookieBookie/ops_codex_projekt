# Dynamicke prikazy pro spusteni

Tyto prikazy jsou napsane tak, aby fungovaly po stazeni projektu na jiny pocitac. Nepouzivaji zadnou pevnou cestu z puvodniho pocitace.

## 1. Co musi byt nainstalovane

Nejjednodussi varianta pouziva Node.js.

Overeni:

```powershell
node --version
npm --version
```

Kdyz prikaz nefunguje, nainstaluj Node.js LTS z webu:

```text
https://nodejs.org/
```

Ve skole muze byt Node.js uz nainstalovany. Pokud neni, pouzij Python variantu niz, pokud je dostupny Python.

## 2. Windows PowerShell

Otevri PowerShell ve slozce, kam jsi projekt rozbalil.

Kdyz je projekt ve Stazenych souborech:

```powershell
cd "$env:USERPROFILE\Downloads\ai-study-planner"
```

Kdyz se slozka jmenuje jinak, napriklad po stazeni ze ZIPu:

```powershell
cd "$env:USERPROFILE\Downloads\ai-study-planner-main"
```

Spust cele demo:

```powershell
npm.cmd run demo
```

Pak otevri:

```text
http://127.0.0.1:4173
```

## 3. Windows bez npm

Pokud `npm.cmd` nefunguje, ale `node` ano:

```powershell
node .\generate_plan.js
node .\validate_plan.js
node .\serve.js
```

Pak otevri:

```text
http://127.0.0.1:4173
```

## 4. macOS nebo Linux

Otevri Terminal ve slozce projektu.

Typicky priklad pro slozku Downloads:

```bash
cd "$HOME/Downloads/ai-study-planner"
```

Spust cele demo:

```bash
npm run demo
```

Nebo bez npm:

```bash
node generate_plan.js
node validate_plan.js
node serve.js
```

Pak otevri:

```text
http://127.0.0.1:4173
```

## 5. Zmena portu

Kdyz je port 4173 obsazeny, zvol jiny:

Windows PowerShell:

```powershell
$env:PORT="8080"
npm.cmd run serve
```

macOS nebo Linux:

```bash
PORT=8080 npm run serve
```

Pak otevri:

```text
http://127.0.0.1:8080
```

## 6. Python varianta

Pouzij ji, kdyz skola nema Node.js, ale ma Python.

Windows:

```powershell
python .\generate_plan.py
python .\validate_plan.py
python -m http.server 4173
```

macOS nebo Linux:

```bash
python3 generate_plan.py
python3 validate_plan.py
python3 -m http.server 4173
```

Pak otevri:

```text
http://127.0.0.1:4173
```

## 7. Rychla ukazka zive zmeny

1. Otevri `subjects.json`.
2. Pridej novy predmet.
3. Znovu spust:

```powershell
npm.cmd run generate
npm.cmd run validate
```

4. Obnov stranku v prohlizeci.

Tim ukazes, ze vstupni data zmenila vystupni soubory i webovou aplikaci.

## 8. Po kazde zmene subjects.json

Stranka `index.html` necita `subjects.json` primo. Nejdřív se musi znovu vytvorit `plan.json` a `index.html`.

Pro priste po kazde zmene `subjects.json` spust:

```powershell
npm.cmd run generate
npm.cmd run validate
```

A potom obnov stranku v prohlizeci.

## 9. Kdyz se neco zasekne

Zastaveni serveru v terminalu:

```text
Ctrl+C
```

Kontrola, ze jsi ve spravne slozce:

Windows:

```powershell
dir
```

macOS nebo Linux:

```bash
ls
```

Ve vypisu by mely byt soubory `subjects.json`, `generate_plan.js`, `index.html` a `package.json`.
