# Vysvětlení výsledku

Codex jako AI operační vrstva provedl úkol v pěti krocích:

1. Přečetl vstupní data ze souboru `subjects.json`.
2. Ověřil, že data mají správný tvar, platná data testů a obtížnost 1-5.
3. Převedl předměty a témata na jednotlivé studijní úkoly.
4. Seřadil úkoly podle obtížnosti a blížícího se testu.
5. Uložil výsledek do `plan.json`, který zobrazuje stránka `index.html`.

## Shrnutí

- Počet předmětů: 4
- Počet naplánovaných úkolů: 10
- Nejnáročnější předmět: Matematika
- Použitý princip: vyšší obtížnost a bližší termín mají větší prioritu

Tato ukázka demonstruje, že Codex nevytváří jen textovou odpověď. Řídí malý proces nad projektem: čte data, plánuje, zapisuje výstup, kontroluje chyby a vysvětluje rozhodnutí.
