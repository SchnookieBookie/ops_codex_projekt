# Dynamické příkazy pro spuštění

Tyto příkazy jsou napsané tak, aby fungovaly po stažení projektu na jiný počítač. Nepoužívají žádnou pevnou cestu z původního počítače.

## 1. Co musí být nainstalované

Nejjednodušší varianta používá Node.js.

Ověření:

```powershell
node --version
npm --version
```

Když příkaz nefunguje, nainstaluj Node.js LTS z webu:

```text
https://nodejs.org/
```

Ve škole může být Node.js už nainstalovaný. Pokud není, použij Python variantu níž, pokud je dostupný Python.

## 2. Windows PowerShell

Otevři PowerShell ve složce, kam jsi projekt rozbalil.

Když je projekt ve Stažených souborech:

```powershell
cd "$env:USERPROFILE\Downloads\ai-study-planner"
```

Když se složka jmenuje jinak, například po stažení ze ZIPu:

```powershell
cd "$env:USERPROFILE\Downloads\ai-study-planner-main"
```

Spusť celé demo:

```powershell
npm.cmd run demo
```

Pak otevři:

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

Pak otevři:

```text
http://127.0.0.1:4173
```

## 4. macOS nebo Linux

Otevři Terminal ve složce projektu.

Typický příklad pro složku Downloads:

```bash
cd "$HOME/Downloads/ai-study-planner"
```

Spusť celé demo:

```bash
npm run demo
```

Nebo bez npm:

```bash
node generate_plan.js
node validate_plan.js
node serve.js
```

Pak otevři:

```text
http://127.0.0.1:4173
```

## 5. Změna portu

Když je port 4173 obsazený, zvol jiný:

Windows PowerShell:

```powershell
$env:PORT="8080"
npm.cmd run serve
```

macOS nebo Linux:

```bash
PORT=8080 npm run serve
```

Pak otevři:

```text
http://127.0.0.1:8080
```

## 6. Python varianta

Použij ji, když škola nemá Node.js, ale má Python.

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

Pak otevři:

```text
http://127.0.0.1:4173
```

## 7. Rychlá ukázka živé změny

1. Otevři `subjects.json`.
2. Přidej nový předmět.
3. Znovu spusť:

```powershell
npm.cmd run generate
npm.cmd run validate
```

4. Obnov stránku v prohlížeči.

Tím ukážeš, že vstupní data změnila výstupní soubory i webovou aplikaci.

## 8. Po každé změně subjects.json

Stránka `index.html` nečte `subjects.json` přímo. Nejdřív se musí znovu vytvořit `plan.json` a `index.html`.

Po každé změně `subjects.json` spusť:

```powershell
npm.cmd run generate
npm.cmd run validate
```

A potom obnov stránku v prohlížeči.

## 9. Když se něco zasekne

Zastavení serveru v terminálu:

```text
Ctrl+C
```

Kontrola, že jsi ve správné složce:

Windows:

```powershell
dir
```

macOS nebo Linux:

```bash
ls
```

Ve výpisu by měly být soubory `subjects.json`, `generate_plan.js`, `index.html` a `package.json`.
