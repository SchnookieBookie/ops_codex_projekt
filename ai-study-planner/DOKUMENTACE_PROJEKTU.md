# AI Study Planner

## Školní dokumentace projektu

| Položka | Údaj |
|---|---|
| Název projektu | AI Study Planner |
| Téma | Použití AI nástrojů formou desktopové aplikace |
| Škola | Doplň název školy |
| Řešitel projektu | Doplň jméno |
| Datum zpracování | 30. 5. 2026 |
| Repozitář GitHub | Doplň odkaz na repozitář |
| Použité prostředí | Codex desktop, Node.js, lokální webový server |
| Poznámka k GNU/Linuxu | Povinnost GNU/Linuxu byla u tohoto tématu nahrazena prací v Codex desktop po konzultaci s vyučujícím. V návodu jsou přesto uvedené i příkazy pro Linux/macOS. |

---

## Obsah

1. Úvod
2. Cíl projektu
3. Praktické využití
4. Použité materiály a nástroje
5. Ověřitelné cíle
6. Postup řešení
7. Návod pro spolužáky
8. Dokumentace testování
9. Rozdělení práce
10. Závěr
11. Použité zdroje
12. Příloha: příprava PDF

---

## 1. Úvod

Projekt AI Study Planner vznikl jako praktická ukázka použití nástroje Codex při práci na menším softwarovém projektu. Hlavní myšlenkou projektu je předvést, že AI nástroj nemusí sloužit pouze k psaní odpovědí v chatu, ale může být použit jako pracovní prostředí pro návrh, úpravu, kontrolu a dokumentaci projektu. Zvolená úloha patří do oblasti použití AI nástrojů formou desktopové aplikace.

Výsledkem projektu je jednoduchá webová aplikace, která ze vstupních školních dat vytvoří studijní plán. Vstupem je soubor `subjects.json`, ve kterém jsou uložené předměty, termíny testů, obtížnost a témata k učení. Program tato data načte, rozdělí je na jednotlivé studijní úkoly, seřadí je podle priority a uloží výsledek do souboru `plan.json`. Výsledek je potom zobrazen na webové stránce `index.html`.

Projekt zároveň obsahuje ověřovací část. Skript `validate_plan.js` kontroluje, zda jsou vstupní data použitelná a zda vytvořený plán obsahuje všechna témata ze vstupního souboru. Kontrola je důležitá, protože projekt nemá pouze vytvořit hezky vypadající stránku, ale také ověřit, že výstup odpovídá zadaným datům. Díky tomu je možné ukázat rozdíl mezi běžnou textovou odpovědí od AI a praktickým výsledkem, který lze spustit, otestovat a zkontrolovat.

Codex byl v projektu použit jako pomocník při návrhu řešení, úpravě souborů, opravě chyb, kontrole výstupu a přípravě dokumentace. Praktická část projektu tedy neukazuje pouze samotný plánovač učení, ale také způsob práce s AI nástrojem. Codex v tomto případě funguje jako vrstva nad projektem: uživatel zadává cíl běžným jazykem a nástroj pomáhá s konkrétní realizací v souborech.

Projekt je navržen tak, aby ho zvládli spustit i spolužáci podle návodu. Nevyžaduje databázi ani složitou instalaci. Pro základní spuštění stačí Node.js, terminál a webový prohlížeč. Z tohoto důvodu je vhodný pro krátkou školní demonstraci, ve které lze ukázat vstupní data, spuštění generátoru, kontrolu výsledku a zobrazení webové stránky.

---

## 2. Cíl projektu

Cílem projektu je připravit a prakticky ověřit jednoduchou aplikaci, která:

- načte školní data ze souboru `subjects.json`,
- vytvoří studijní plán podle obtížnosti a termínů testů,
- uloží výsledek do souboru `plan.json`,
- ověří správnost výsledku pomocí validátoru,
- zobrazí výsledek jako lokální webovou stránku,
- ukáže použití Codexu jako AI nástroje pro práci nad projektem.

Projekt má zároveň sloužit jako návod pro spolužáky. Spolužák by měl být schopný projekt stáhnout, spustit, ověřit a upravit vstupní data podle popsaného postupu.

---

## 3. Praktické využití

V praxi se podobný princip dá použít pro jednoduché plánování práce. Student může mít více předmětů, různé termíny testů a odlišnou obtížnost jednotlivých témat. Ruční rozdělení úkolů může být nepřehledné, hlavně když se vstupní data mění. Tento projekt ukazuje základní variantu automatického zpracování takových dat.

Projekt také ukazuje obecnější princip, který se používá i v běžné administrativní a IT práci:

- data jsou uložená ve strukturovaném souboru,
- skript je zpracuje podle pravidel,
- výstup se ověří,
- výsledek se zobrazí uživateli.

Na stejném principu mohou fungovat například jednoduché reporty, rozpisy služeb, kontrolní seznamy, evidence úkolů nebo automatické přehledy. V tomto projektu je použit školní příklad, ale samotný postup je obecně použitelný.

---

## 4. Použité materiály a nástroje

| Nástroj nebo soubor | Účel |
|---|---|
| Codex desktop | Pomoc při návrhu, úpravě a kontrole projektu |
| Node.js | Spouštění JavaScriptových skriptů mimo prohlížeč |
| JavaScript | Generování plánu, validace a lokální server |
| HTML | Struktura webové stránky |
| CSS | Vzhled webové stránky |
| JSON | Uložení vstupních dat a výsledného plánu |
| Webový prohlížeč | Zobrazení výsledku |
| GitHub | Uložení dokumentace a zdrojových souborů |

### Hlavní soubory projektu

| Soubor | Popis |
|---|---|
| `subjects.json` | Vstupní data o předmětech |
| `generate_plan.js` | Vytvoří studijní plán |
| `validate_plan.js` | Zkontroluje vstupní data a výstup |
| `plan.json` | Vygenerovaný studijní plán |
| `index.html` | Webové zobrazení plánu |
| `style.css` | Vzhled webové stránky |
| `serve.js` | Lokální webový server |
| `README.md` | Krátký návod ke spuštění |
| `RUN_COMMANDS.md` | Přenositelné příkazy pro různá prostředí |
| `explanation.md` | Vysvětlení výsledku generování |

---

## 5. Ověřitelné cíle

| Cíl | Způsob ověření | Očekávaný výsledek |
|---|---|---|
| Projekt lze spustit | Spustit `npm.cmd run demo` | Spustí se generování, validace a server |
| Generátor vytvoří plán | Spustit `npm.cmd run generate` | Vznikne nebo se aktualizuje `plan.json`, `index.html` a `explanation.md` |
| Validace projde při správných datech | Spustit `npm.cmd run validate` | Zobrazí se zpráva, že validace prošla |
| Webová stránka se zobrazí | Otevřít `http://127.0.0.1:4173` | Zobrazí se třídenní studijní plán |
| Změna vstupu změní výstup | Upravit `subjects.json` a znovu spustit generátor | Plán na stránce se změní podle nových dat |
| Chybná data jsou odhalena | Nastavit obtížnost mimo rozsah 1-5 a spustit validaci | Validace skončí chybou |

---

## 6. Postup řešení

### 6.1 Návrh úlohy

Nejdříve byla zvolena úloha, která je jednoduchá na pochopení a zároveň umožňuje ukázat více částí práce s projektem. Zvolen byl studijní plánovač, protože má jasný vstup, jasný výstup a dá se snadno ověřit.

Vstupní data obsahují:

- název předmětu,
- datum testu,
- obtížnost od 1 do 5,
- seznam témat k učení.

### 6.2 Vytvoření vstupních dat

Vstupní soubor `subjects.json` obsahuje několik předmětů. Každý předmět má vlastní témata a obtížnost. Díky tomu se dá jednoduše ukázat, že změna vstupních dat ovlivní výsledný plán.

Ukázka jednoho záznamu:

```json
{
  "subject": "Matematika",
  "testDate": "2026-06-03",
  "difficulty": 5,
  "topics": ["rovnice", "funkce", "grafy"]
}
```

### 6.3 Generování plánu

Skript `generate_plan.js` načte vstupní data, převede jednotlivá témata na úkoly a vypočítá prioritu. Priorita vychází z obtížnosti a blížícího se termínu testu. Náročnější předmět a bližší test dostanou vyšší prioritu.

Výstupem generátoru jsou tři soubory:

- `plan.json`,
- `index.html`,
- `explanation.md`.

### 6.4 Validace výsledku

Skript `validate_plan.js` kontroluje dvě hlavní věci:

- zda jsou vstupní data ve správném tvaru,
- zda plán obsahuje všechna témata ze vstupu.

Validátor kontroluje například to, že obtížnost je celé číslo od 1 do 5, datum má správný formát a žádné téma není prázdné. Tato část je důležitá pro praktické ověření projektu.

### 6.5 Webové zobrazení

Soubor `index.html` zobrazuje výsledný plán jako jednoduchou webovou stránku. Stránka obsahuje úvod, vysvětlení pravidel plánování a třídenní rozpis úkolů. Vzhled stránky je upravený pomocí souboru `style.css`.

### 6.6 Role Codexu

Codex byl použit při návrhu a úpravách projektu. Pomohl vytvořit strukturu souborů, opravit chyby, doplnit validaci a připravit dokumentaci. V projektu je důležité, že výsledek nebyl pouze text v chatu. Codex pracoval s konkrétními soubory a výsledek se dal ověřit spuštěním příkazů.

---

## 7. Návod pro spolužáky

### 7.1 Stažení projektu

Projekt stáhni z GitHubu nebo zkopíruj složku `ai-study-planner` do počítače. Potom otevři terminál ve složce projektu.

Na Windows může cesta vypadat například takto:

```powershell
cd "$env:USERPROFILE\Downloads\ai-study-planner"
```

Na Linuxu nebo macOS:

```bash
cd "$HOME/Downloads/ai-study-planner"
```

Poznámka: Projekt byl prakticky ověřen v prostředí Codex desktop na Windows. Příkazy pro Linux/macOS jsou uvedené proto, aby byl návod přenositelný na jiné školní počítače.

### 7.2 Ověření Node.js

Nejdřív ověř, že je dostupný Node.js:

```powershell
node --version
```

Ověř také npm:

```powershell
npm --version
```

Pokud se verze zobrazí, prostředí je připravené.

### 7.3 Spuštění celého dema

Na Windows v PowerShellu spusť:

```powershell
npm.cmd run demo
```

Na Linuxu nebo macOS spusť:

```bash
npm run demo
```

Potom otevři v prohlížeči:

```text
http://127.0.0.1:4173
```

### 7.4 Samostatné spuštění kroků

Generování plánu:

```powershell
npm.cmd run generate
```

Validace:

```powershell
npm.cmd run validate
```

Spuštění webového serveru:

```powershell
npm.cmd run serve
```

### 7.5 Ukázka změny vstupu

1. Otevři soubor `subjects.json`.
2. Přidej nový předmět nebo změň obtížnost existujícího předmětu.
3. Znovu spusť generování:

```powershell
npm.cmd run generate
```

4. Spusť validaci:

```powershell
npm.cmd run validate
```

5. Obnov stránku v prohlížeči.

Tím se ověří, že aplikace nereaguje pouze na pevně napsaný obsah, ale skutečně pracuje se vstupními daty.

---

## 8. Dokumentace testování

### Test 1: Generování plánu

| Položka | Výsledek |
|---|---|
| Příkaz | `npm.cmd run generate` |
| Očekávání | Vytvoří se `plan.json`, `index.html` a `explanation.md` |
| Skutečný výsledek | Generování proběhlo úspěšně |
| Stav | Splněno |

### Test 2: Validace správných dat

| Položka | Výsledek |
|---|---|
| Příkaz | `npm.cmd run validate` |
| Očekávání | Validace projde bez chyby |
| Skutečný výsledek | Validace prošla |
| Stav | Splněno |

### Test 3: Zobrazení webové stránky

| Položka | Výsledek |
|---|---|
| Adresa | `http://127.0.0.1:4173` |
| Očekávání | Zobrazí se studijní plán |
| Skutečný výsledek | Stránka se zobrazila |
| Stav | Splněno |

### Test 4: Kontrola chybných dat

| Položka | Výsledek |
|---|---|
| Úprava | V souboru `subjects.json` byla zkušebně nastavena obtížnost mimo rozsah 1-5 |
| Očekávání | Validace chybu odhalí |
| Skutečný výsledek | Validace oznámí chybu v hodnotě `difficulty` |
| Stav | Splněno |

### Doporučené screenshoty do PDF

Do PDF dokumentace je vhodné vložit tyto obrázky:

| Obrázek | Obsah |
|---|---|
| Obrázek 1 | Struktura složky projektu |
| Obrázek 2 | Soubor `subjects.json` se vstupními daty |
| Obrázek 3 | Terminál po úspěšném spuštění validace |
| Obrázek 4 | Webová stránka AI Study Planner |
| Obrázek 5 | Ukázka práce s Codexem |

---

## 9. Rozdělení práce

Projekt byl zpracován samostatně po konzultaci s vyučujícím. Důvodem je zvolené téma, ve kterém byla praktická část postavená na práci s Codexem jako desktopovým AI nástrojem.

Pro přehlednost byla práce rozdělena do tří pracovních rolí:

| Role | Náplň práce |
|---|---|
| Návrh a plánování | Výběr úlohy, popis cíle, návrh struktury projektu |
| Technická realizace | Vytvoření vstupních dat, generátoru, validátoru a webové stránky |
| Dokumentace a prezentace | Popis postupu, návod pro spolužáky, testování a příprava závěru |

Všechny části projektu musí umět autor projektu vysvětlit a předvést bez návodu. Při obhajobě je potřeba ukázat spuštění generování, validaci a otevření webové stránky.

---

## 10. Závěr

Projekt splnil hlavní cíl: vznikla jednoduchá aplikace, která ze vstupních dat vytvoří studijní plán, ověří jeho správnost a zobrazí výsledek jako webovou stránku. Součástí projektu je také návod pro spuštění a dokumentace testování.

Povedlo se vytvořit přehlednou strukturu projektu, funkční generátor plánu, validaci vstupních dat a lokální webové zobrazení. Silnou částí projektu je to, že výstup je ověřitelný. Nejde pouze o textový návrh, ale o soubory a příkazy, které lze prakticky spustit.

Nepovedlo se plně ověřit Python variantu na použitém počítači, protože systém neměl dostupný příkaz `python` ani `py`. Proto byla jako hlavní a ověřená cesta použita varianta přes Node.js. Python soubory v projektu zůstávají jako doplňková možnost pro počítač, kde je Python správně nainstalovaný.

Při práci bylo potřeba vyřešit problém s poškozeným zobrazením českých znaků a také chybnou hodnotu obtížnosti ve vstupních datech. Tyto problémy byly opraveny a validace byla rozšířena tak, aby podobné chyby dokázala odhalit.

Jinou variantou řešení by bylo vytvořit aplikaci s databází nebo použít hotový webový framework. Výhodou takové varianty by byla větší rozšiřitelnost. Nevýhodou by byla složitější instalace a horší vhodnost pro krátkou školní ukázku. Zvolená varianta je jednodušší, přehledná a dá se snadno zkopírovat na jiný počítač.

Ten, kdo bude projekt zkoušet podle návodu, by si měl dát pozor hlavně na správné umístění terminálu ve složce projektu, nainstalovaný Node.js a správný formát souboru `subjects.json`. Po každé změně vstupních dat je potřeba znovu spustit generování a validaci.

V projektu by se dalo pokračovat například přidáním formuláře pro úpravu předmětů přímo ve webové stránce, exportem plánu do PDF, ukládáním více plánů nebo napojením na databázi. Dalším rozšířením by bylo porovnání práce v Codexu s běžným ručním postupem bez AI nástroje.

---

## 11. Použité zdroje

Zdroje jsou zapsané zjednodušenou formou podle citační normy. Před finálním odevzdáním je možné je převést přes Citace.com.

1. MICROSOFT. NodeJS ve Windows. Microsoft Learn [online]. Microsoft, 2025 [cit. 2026-05-30]. Dostupné z: https://learn.microsoft.com/cs-cz/windows/dev-environment/javascript/nodejs-overview

2. WIKIPEDIE. JavaScript. Česká Wikipedie [online]. Wikimedia Foundation [cit. 2026-05-30]. Dostupné z: https://www.czech.wiki/wiki/JavaScript

3. WIKIPEDIE. Hypertext Markup Language. Česká Wikipedie [online]. Wikimedia Foundation [cit. 2026-05-30]. Dostupné z: https://www.czech.wiki/wiki/Hypertext_Markup_Language

4. WIKIPEDIE. Linux. Česká Wikipedie [online]. Wikimedia Foundation [cit. 2026-05-30]. Dostupné z: https://www.czech.wiki/wiki/Linux_%28j%C3%A1dro%29

5. OPENAI. Konverzace s nástrojem Codex při tvorbě projektu AI Study Planner [online]. OpenAI, 2026 [cit. 2026-05-30]. Použito pro návrh struktury projektu, úpravu souborů a přípravu dokumentace.

---

## Příloha: Krátký text pro prezentaci

Tento projekt se jmenuje AI Study Planner. Je to jednoduchá školní mini-laboratoř, která ukazuje použití Codexu jako AI nástroje nad projektem.

Vstupem jsou školní data v souboru `subjects.json`. Jsou tam uložené předměty, témata k učení, obtížnost a datum testu. Program tato data načte a pomocí skriptu `generate_plan.js` vytvoří studijní plán na několik dnů. Výsledek se uloží do souboru `plan.json` a zobrazí se na lokální webové stránce.

Součástí projektu je také kontrola pomocí `validate_plan.js`. Ta ověřuje, že vstupní data dávají smysl a že plán obsahuje všechna témata. Díky tomu nejde jen o náhodně vytvořený text, ale o výsledek, který se dá ověřit.

Codex zde nefunguje pouze jako chatbot. Pomohl s návrhem, úpravou souborů, kontrolou chyb a dokumentací. Projekt proto ukazuje praktické použití AI nástroje při tvorbě menší aplikace.

---

## Příloha: Příprava PDF

Pro odevzdání je vhodné převést tento soubor do PDF. Doporučený postup:

1. Otevřít dokument v editoru, který umí náhled Markdownu, například Visual Studio Code.
2. Doplnit název školy, jméno řešitele a odkaz na GitHub repozitář.
3. Vložit screenshoty do části Dokumentace testování.
4. Zkontrolovat nadpisy, tabulky a zalomení stránek.
5. Exportovat do PDF.
6. V PDF zkontrolovat titulní část, čitelnost tabulek a číslování stránek.

Při exportu do PDF je vhodné zapnout:

- titulní stránku,
- čísla stránek,
- okraje dokumentu,
- jednotný font,
- automatický obsah, pokud ho použitý editor podporuje.
