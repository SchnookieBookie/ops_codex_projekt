<?php

declare(strict_types=1);

final class ContentRepository
{
    public function title(): string
    {
        return 'Jak používat OpenAI Codex';
    }

    public function subtitle(): string
    {
        return 'Webový návod: stáhnout, otevřít, zkopírovat a použít při práci s Codex desktop app a Codex panelem ve VS Code.';
    }

    public function screenshots(): array
    {
        return [
            'install-download' => [
                'file' => 'assets/screenshots/00-01-codex-download.png',
                'caption' => 'Stránka OpenAI Codex s tlačítkem Download for Windows.',
            ],
            'install-file' => [
                'file' => 'assets/screenshots/00-02-codex-installer.png',
                'caption' => 'Pokyny pro instalaci Codexu pomocí PowerShell příkazů.',
            ],
            'install-login' => [
                'file' => 'assets/screenshots/00-03-codex-login-options.png',
                'caption' => 'Úvodní přihlášení do Codexu přes ChatGPT nebo jinou přihlašovací metodu.',
            ],
            'install-ready' => [
                'file' => 'assets/screenshots/00-04-codex-ready.png',
                'caption' => 'Ověření identity pomocí jednorázového kódu při přihlašování.',
            ],
            'install-project-choice' => [
                'file' => 'assets/screenshots/00-05-codex-project-choice.png',
                'caption' => 'Potvrzení přihlášení do Codexu pomocí vybraného ChatGPT účtu.',
            ],
            'install-first-thread' => [
                'file' => 'assets/screenshots/00-06-codex-first-thread.png',
                'caption' => 'Základní obrazovka Codexu s levým panelem, composerem a volbou Work in a project.',
            ],
            'vscode-source-control' => [
                'file' => 'assets/screenshots/01-vscode-source-control-codex.png',
                'caption' => 'VS Code se Source Control panelem, upraveným souborem generate_plan.js a Codex panelem vpravo.',
            ],
            'vscode-terminal' => [
                'file' => 'assets/screenshots/02-vscode-terminal-codex.png',
                'caption' => 'VS Code s integrovaným PowerShell terminálem, výstupem git status a Codex panelem.',
            ],
            'git-tools-placeholder' => [
                'file' => 'assets/screenshots/05-git-tools-diff-placeholder.png',
                'caption' => 'Git nástroje ve VS Code ukazují sledovaný projekt, upravený soubor a práci se změnami.',
            ],
            'reasoning' => [
                'file' => 'assets/screenshots/03-reasoning-model-menu.png',
                'caption' => 'Nabídka pro výběr reasoning effort a modelu přímo v composeru Codexu.',
            ],
            'speed' => [
                'file' => 'assets/screenshots/04-speed-menu.png',
                'caption' => 'Volba rychlosti odpovědí, kde lze přepnout mezi Standard a Fast režimem.',
            ],
            'slash' => [
                'file' => 'assets/screenshots/05-slash-commands.png',
                'caption' => 'Nabídka slash příkazů v composeru, například Code review, Goal, MCP, Model nebo Plan mode.',
            ],
            'permissions' => [
                'file' => 'assets/screenshots/06-permissions-menu.png',
                'caption' => 'Volba režimu oprávnění pro schvalování akcí Codexu.',
            ],
            'project' => [
                'file' => 'assets/screenshots/07-work-in-project-menu.png',
                'caption' => 'Výběr práce v projektu: Start from scratch nebo Use an existing folder.',
            ],
            'github-plugin' => [
                'file' => 'assets/screenshots/08-github-plugin.png',
                'caption' => 'GitHub plugin v Codex app s připojeným účtem a dostupnými skills pro GitHub workflow.',
            ],
        ];
    }

    public function sections(): array
    {
        return [
            [
                'id' => 'stazeni-prihlaseni',
                'title' => '1.  Stažení, instalace a přihlášení do Codexu',
                'lead' => 'Tato část je úplný začátek. Slouží pro uživatele, který ještě Codex desktop app nikdy neotevřel.',
                'steps' => [
                    'Otevřete oficiální zdroj OpenAI nebo odkaz, který Vám poskytl vyučující.',
                    'Stáhněte instalátor Codex desktop app pro svůj operační systém.',
                    'Spusťte instalátor a projděte běžnými instalačními kroky.',
                    'Po instalaci otevřete Codex desktop app.',
                    'Na přihlašovací obrazovce vyberte dostupný způsob přihlášení.',
                    'Přihlásit se můžete podle toho, co Vám aplikace nabídne: e-mailem a heslem, účtem Google, účtem Microsoft, účtem Apple nebo školním/organizačním SSO.',
                    'Po přihlášení zkontrolujte, že vidíte levý panel aplikace a composer pro zadání úkolu.',
                ],
                'tips' => [
                    'Možnosti přihlášení se mohou lišit podle účtu, školy nebo organizace.',
                    'Pokud některá možnost přihlášení chybí, použijte tu, kterou máte povolenou ve svém OpenAI nebo ChatGPT účtu.',
                    'Do dokumentace vložte screenshoty každého kroku, aby spolužák viděl, co má hledat.',
                ],
                'screenshots' => ['install-download', 'install-file', 'install-login', 'install-ready', 'install-project-choice', 'install-first-thread'],
            ],
            [
                'id' => 'zakladni-obrazovka',
                'title' => '2. Základní obrazovka Codexu',
                'lead' => 'Základní obrazovka slouží k práci s thready, projekty, pluginy, automations a composerem.',
                'steps' => [
                    'Otevřete Codex desktop app nebo Codex panel ve VS Code.',
                    'V levém panelu vyberte New chat, Project, Plugins nebo Automations podle toho, co chcete dělat.',
                    'V composeru dole napište úkol pro Codex.',
                    'Před odesláním zkontrolujte režim oprávnění, model, reasoning effort a pracovní prostředí.',
                ],
                'tips' => [
                    'Jeden thread používejte pro jednu souvislou práci.',
                    'Pro školní ukázku je vhodné mít vidět levý panel, aktivní thread a composer.',
                ],
            ],
            [
                'id' => 'projekt',
                'title' => '3. Otevření projektu a práce s lokální složkou',
                'lead' => 'Codex je nejsilnější ve chvíli, kdy nepracuje jen jako chat, ale má otevřenou konkrétní složku projektu.',
                'steps' => [
                    'Klikněte na Work in a project nebo Work locally.',
                    'Vyberte Use an existing folder, pokud už projekt existuje.',
                    'Vyberte lokální složku projektu.',
                    'Nejdříve zadejte pouze analytický úkol, aby Codex nic neměnil.',
                ],
                'commands' => [
                    ['První bezpečný prompt', 'Popište strukturu projektu a najděte hlavní vstupní soubor. Neprovádějte žádné změny.'],
                ],
                'screenshots' => ['project'],
            ],
            [
                'id' => 'local-vscode',
                'title' => '4. Local režim, VS Code a IDE kontext',
                'lead' => 'Local režim znamená, že Codex pracuje s aktuální lokální složkou. Ve VS Code se k tomu hodí Source Control, Explorer, otevřené soubory a Codex panel.',
                'steps' => [
                    'Otevřete projekt ve VS Code.',
                    'Otevřete Codex panel vpravo.',
                    'Nechte Codex pracovat v režimu Work locally.',
                    'Zadejte malou změnu v jednom souboru.',
                    'Po úpravě zkontrolujte Source Control panel.',
                ],
                'tips' => [
                    'Local používejte pro menší změny, které chcete hned vidět v hlavním projektu.',
                    'Před větší úpravou vytvořte commit nebo použijte Worktree.',
                ],
                'screenshots' => ['vscode-source-control'],
            ],
            [
                'id' => 'git-tools',
                'title' => '5. Git nástroje: diff, stage, revert a review',
                'lead' => 'Git nástroje slouží ke kontrole toho, co Codex změnil. Ve VS Code je najdete v Source Control panelu.',
                'steps' => [
                    'Klikněte na Source Control.',
                    'Vyberte změněný soubor.',
                    'Prohlédněte si změny nebo otevřete diff, pokud je dostupný.',
                    'Pomocí plus připravte soubor ke commitu.',
                    'Pomocí discard/revert vraťte nechtěnou změnu.',
                    'Komentáře k řádkům používejte hlavně v pull request review nebo přes GitHub integraci.',
                ],
                'tips' => [
                    'Každou větší změnu od Codexu kontrolujte v diffu.',
                    'Stage znamená připravit změnu ke commitu, revert/discard znamená změnu zahodit.',
                ],
                'screenshots' => ['git-tools-placeholder'],
            ],
            [
                'id' => 'terminal',
                'title' => '6. Integrovaný terminál',
                'lead' => 'Terminál se používá pro spuštění testů, validace, lintů, buildu, lokálního serveru nebo Git příkazů.',
                'steps' => [
                    'Ve VS Code otevřete Terminal → New Terminal.',
                    'Zkontrolujte, že terminál běží ve složce projektu.',
                    'Spusťte potřebný příkaz.',
                    'Požádejte Codex, aby vysvětlil výstup terminálu nebo navrhl opravu chyby.',
                ],
                'commands' => [
                    ['Příklad validace', 'npm.cmd run validate'],
                    ['Příklad Git kontroly', 'git status'],
                ],
                'screenshots' => ['vscode-terminal'],
            ],
            [
                'id' => 'modes',
                'title' => '7. Režimy Local, Worktree a Cloud',
                'lead' => 'Režim určuje, kde Codex provádí práci a jak moc je oddělená od hlavního projektu.',
                'blocks' => [
                    ['Local', 'Práce přímo v aktuální lokální složce. Režim je rychlý a jednoduchý, ale změny vznikají rovnou v hlavním checkoutu.'],
                    ['Worktree', 'Izolovaná pracovní složka v Git repozitáři. Hodí se pro experimenty, paralelní úkoly a větší refaktory.'],
                    ['Cloud', 'Delegování úlohy do vzdáleného prostředí. Hodí se pro oddělené cloudové tasky, ale nemusí mít stejný přístup k lokálním souborům.'],
                ],
                'commands' => [
                    ['Ruční ukázka Worktree přes Git', "git worktree add ..\\nazev-projektu-worktree-test -b test-worktree\ngit worktree list"],
                ],
                'tips' => [
                    'Worktree vyžaduje Git repozitář a alespoň jeden commit.',
                    'Cloud používejte tehdy, když nepotřebujete přímý přístup k lokálním souborům.',
                ],
            ],
            [
                'id' => 'modely',
                'title' => '8. Model, reasoning effort a speed',
                'lead' => 'Model, reasoning effort a speed nastavují, jak důkladně a jak rychle bude Codex pracovat.',
                'blocks' => [
                    ['Model', 'Vyberte model podle náročnosti úkolu. Silnější model je vhodný pro architekturu, debugging a dlouhé úpravy. Menší nebo rychlejší model se hodí pro kratší rutinní práci.'],
                    ['Low reasoning', 'Použijte pro rychlé a jednoduché úkoly, například krátké vysvětlení nebo malou izolovanou změnu.'],
                    ['Medium reasoning', 'Použijte jako běžný kompromis pro každodenní práci.'],
                    ['High reasoning', 'Použijte pro složitější debugging, návrh řešení nebo změny ve více souborech.'],
                    ['Extra High reasoning', 'Použijte pro nejtěžší úkoly, delší plánování a kontrolu složitých dopadů. Počítejte s pomalejší odpovědí.'],
                    ['Standard speed', 'Výchozí rychlost pro většinu práce.'],
                    ['Fast speed', 'Rychlejší odpovědi vhodné pro lehčí úkoly. Může zvýšit usage a nemusí být ideální pro složité plánování.'],
                ],
                'steps' => [
                    'Klikněte na nabídku modelu a reasoning v composeru.',
                    'Vyberte reasoning podle obtížnosti úkolu.',
                    'V nabídce Speed zvolte Standard nebo Fast.',
                ],
                'screenshots' => ['reasoning', 'speed'],
            ],
            [
                'id' => 'permissions',
                'title' => '9. Permissions, approvals a sandbox',
                'lead' => 'Permissions určují, kdy Codex smí sám upravovat soubory, používat internet nebo spouštět citlivější akce.',
                'blocks' => [
                    ['Ask for approval', 'Codex se ptá častěji. Tuto volbu použijte pro nový, neznámý nebo citlivější projekt.'],
                    ['Approve for me', 'Codex žádá hlavně u akcí, které vyhodnotí jako rizikové. Je to praktický kompromis pro běžnou práci.'],
                    ['Full access', 'Nejširší režim přístupu. Používejte ho jen u důvěryhodného projektu a jasně ohraničeného úkolu.'],
                    ['Sandbox', 'Technická hranice, která omezuje zápis a síť podle nastavení prostředí. Sandbox není náhrada za lidskou kontrolu.'],
                ],
                'steps' => [
                    'Klikněte na nabídku oprávnění v composeru.',
                    'Pro školní nebo neznámý projekt zvolte Ask for approval nebo Approve for me.',
                    'Full access používejte pouze tehdy, když přesně víte, proč ho potřebujete.',
                ],
                'screenshots' => ['permissions'],
            ],
            [
                'id' => 'slash',
                'title' => '10. Slash příkazy a composer controls',
                'lead' => 'Slash příkazy jsou rychlá nabídka pro řízení Codexu. Otevřete ji napsáním lomítka do composeru.',
                'steps' => [
                    'Klikněte do composeru.',
                    'Napište znak /.',
                    'Vyberte příkaz z nabídky.',
                    'Použijte příkaz podle toho, co chcete nastavit nebo zobrazit.',
                ],
                'blocks' => [
                    ['Feedback', 'Odeslání zpětné vazby ke chatu.'],
                    ['Goal', 'Nastavení cíle, ke kterému se má Codex průběžně vracet.'],
                    ['MCP', 'Zobrazení stavu MCP serverů.'],
                    ['Model', 'Výběr modelu.'],
                    ['Personality', 'Volba stylu odpovědí.'],
                    ['Plan mode', 'Zapnutí plánovacího režimu.'],
                    ['Project', 'Výběr projektu pro nové chaty.'],
                    ['Reasoning', 'Rychlá změna reasoning effort.'],
                    ['Speed', 'Volba rychlosti odpovědí.'],
                ],
                'screenshots' => ['slash'],
            ],
            [
                'id' => 'browser',
                'title' => '11. In-app browser a Browser plugin',
                'lead' => 'In-app browser slouží k vizuální kontrole webových stránek. Browser plugin může stránku otevírat, klikat, psát a dělat screenshoty.',
                'steps' => [
                    'Spusťte lokální server projektu.',
                    'Otevřete lokální adresu v in-app browseru nebo běžném prohlížeči.',
                    'Přidejte komentář k problému v UI.',
                    'Požádejte Codex o konkrétní úpravu podle vizuálního problému.',
                    'Po změně stránku obnovte a zkontrolujte výsledek.',
                ],
                'commands' => [
                    ['Příklad spuštění webu', 'npm.cmd run serve'],
                    ['Příklad lokální adresy', 'http://127.0.0.1:4173'],
                ],
                'tips' => [
                    'In-app browser nepoužívejte pro zadávání citlivých přihlašovacích údajů.',
                    'Pro UI práci dávejte screenshoty a konkrétní vizuální připomínky.',
                ],
            ],
            [
                'id' => 'automations',
                'title' => '12. Automations',
                'lead' => 'Automations slouží k opakovaným nebo odloženým úlohám. Mohou být navázané na thread nebo na projekt.',
                'steps' => [
                    'V levém panelu otevřete Automations.',
                    'Vytvořte novou automation.',
                    'Popište úkol tak, aby byl samostatně pochopitelný.',
                    'Vyberte, zda se má výstup vrátit do threadu nebo do Triage.',
                    'Nastavte bezpečná oprávnění a krátký testovací interval.',
                ],
                'commands' => [
                    ['Příklad zadání automation', 'Po dobu 10 minut opakovaně vytvářejte jednoduchý linuxový skript, po každé iteraci zkontrolujte výsledek a navrhněte případnou opravu.'],
                ],
                'tips' => [
                    'Automations běží bez průběžného dohledu, proto nepoužívejte zbytečně Full access.',
                    'Zadání musí být konkrétní a omezené časem nebo jasným cílem.',
                ],
            ],
            [
                'id' => 'skills-plugins-mcp',
                'title' => '13. Skills, Plugins a MCP',
                'lead' => 'Tyto funkce rozšiřují Codex o nové postupy, externí služby a kontext.',
                'blocks' => [
                    ['Skills', 'Opakovatelné dovednosti uložené jako instrukce. Hodí se pro školní formát dokumentace, review checklist nebo pravidla konkrétního frameworku.'],
                    ['Plugins', 'Balíčky schopností a integrací. Mohou přidat Browser, GitHub, Google Drive nebo jiné nástroje.'],
                    ['MCP', 'Model Context Protocol pro napojení na dokumentaci, GitHub, Sentry, Figma nebo vlastní interní nástroje.'],
                    ['GitHub plugin', 'Napojení na repozitáře, issues, pull requesty a CI kontroly.'],
                ],
                'steps' => [
                    'Otevřete panel Plugins.',
                    'Vyberte bezpečný plugin, například GitHub nebo Browser.',
                    'Připojte službu a povolte jen potřebná oprávnění.',
                    'Vyvolejte plugin v chatu pomocí @ nebo přes nabídku pluginu.',
                    'U MCP kontrolujte, jaké nástroje server zpřístupňuje.',
                ],
                'screenshots' => ['github-plugin'],
            ],
            [
                'id' => 'local-environments',
                'title' => '14. Local environments a setup scripts',
                'lead' => 'Local environments připravují projekt pro práci Codexu. Hodí se hlavně u worktrees, kde nová složka nemusí mít nainstalované závislosti.',
                'steps' => [
                    'V projektu určete, jak se instalují závislosti.',
                    'Připravte setup script nebo dokumentovaný postup.',
                    'Při použití Worktree ověřte, že izolovaná složka má stejné nástroje jako hlavní projekt.',
                    'U webu spusťte dev server a zkontrolujte stránku v browseru.',
                ],
                'tips' => [
                    'Setup script nemá mazat data ani měnit systém mimo projekt.',
                    'Před automatizací setupu vždy ověřte, co přesně skript spouští.',
                ],
            ],
            [
                'id' => 'programove-rezimy',
                'title' => '15. Programové režimy: CLI, non-interactive, SDK, App Server a GitHub Action',
                'lead' => 'Pokročilé režimy slouží k tomu, aby Codex nefungoval jen ručně v aplikaci, ale i ve skriptech, interních nástrojích nebo CI.',
                'blocks' => [
                    ['CLI', 'Použití Codexu z příkazové řádky. Hodí se pro technické workflow a skripty.'],
                    ['Non-interactive mode', 'Běh bez interaktivního rozhraní, například pro CI nebo dávkové úlohy.'],
                    ['Codex SDK', 'Programové ovládání Codexu z vlastních aplikací.'],
                    ['App Server', 'Rozhraní pro bohatší klienty a streamed agent events.'],
                    ['MCP Server', 'Vlastní server, který Codexu zpřístupní nástroje a data.'],
                    ['GitHub Action', 'Automatizace v GitHub workflows, například review nebo kontrola změn.'],
                ],
                'tips' => [
                    'V CI nepoužívejte zbytečně široká oprávnění.',
                    'U SDK a serverů řešte autentizaci, logování a rozsah přístupu.',
                ],
            ],
            [
                'id' => 'kompatibilita',
                'title' => '16. Kompatibilita s programy',
                'lead' => 'Codex se dá používat vedle více vývojových a kreativních nástrojů. Hloubka integrace se ale liší.',
                'blocks' => [
                    ['VS Code', 'Velmi vhodné prostředí. Codex panel může využít IDE kontext a lokální projekt.'],
                    ['Cursor a Windsurf', 'Použitelné přes VS Code-compatible prostředí podle dostupnosti rozšíření.'],
                    ['JetBrains IDE', 'Vhodné pro Java, Kotlin, PHP, Python a webové projekty, pokud je dostupná integrace.'],
                    ['Visual Studio', 'Použitelné vedle Codex app, ale nelze automaticky čekat stejnou hloubku integrace jako ve VS Code.'],
                    ['GitHub', 'Vhodný pro issues, pull requesty, CI kontroly a týmovou spolupráci.'],
                    ['Blender a Adobe aplikace', 'Codex může pomoci se skripty, asset pipeline nebo soubory. Přímé GUI ovládání vyžaduje speciální nástroj typu Computer Use.'],
                    ['Localhost weby', 'Jedna z nejsilnějších oblastí: terminál, server, browser a UI iterace v jednom workflow.'],
                ],
            ],
            [
                'id' => 'bezpecnost',
                'title' => '17. Bezpečnostní pravidla',
                'lead' => 'Codex umí pracovat se soubory a nástroji, proto je potřeba kontrolovat rozsah přístupu.',
                'steps' => [
                    'Do promptů nevkládejte hesla, tokeny, API klíče ani osobní údaje.',
                    'Před větší změnou použijte Git commit nebo Worktree.',
                    'U pluginů povolujte jen konkrétní potřebnou službu.',
                    'U web search ověřujte zdroje a datum informací.',
                    'Po změnách kontrolujte diff a spusťte dostupné testy.',
                    'Full access nepoužívejte jako běžný výchozí režim.',
                ],
            ],
        ];
    }

    public function commands(): array
    {
        return [
            ['Analýza projektu', 'Popište strukturu projektu a najděte hlavní vstupní soubor. Neprovádějte žádné změny.'],
            ['Malá lokální úprava', 'V jednom souboru proveďte malou změnu a potom vysvětlete, co se změnilo a proč.'],
            ['Review změn', 'Zkontrolujte aktuální diff a najděte rizika, chyby nebo chybějící testy.'],
            ['Terminál', 'Spusťte dostupnou validaci nebo testy a vysvětlete výsledek terminálu.'],
            ['Browser UI kontrola', 'Otevřete lokální stránku, zkontrolujte rozložení a navrhněte konkrétní UI úpravy.'],
            ['Automation', 'Vytvořte krátkou automatizaci, která se vrátí k threadu a zkontroluje stav úkolu.'],
            ['Web search', 'Ověřte aktuální dokumentaci použité knihovny a uveďte odkazy na zdroje.'],
        ];
    }

    public function troubleshooting(): array
    {
        return [
            ['Codex nevidí projektové soubory.', 'Zkontrolujte, že je vybraná správná složka projektu a lokální režim práce.'],
            ['Git diff nic neukazuje.', 'Ujistěte se, že projekt je Git repozitář a že soubor byl uložen.'],
            ['Worktree nejde vytvořit.', 'Nejdříve vytvořte alespoň jeden commit a potom spusťte git worktree add.'],
            ['Plugin se nespustí přes @.', 'Zkontrolujte, že je plugin nainstalovaný a povolený v panelu Plugins.'],
            ['Codex se ptá na oprávnění.', 'Je to očekávané u rizikovějších akcí. Před schválením zkontrolujte, co chce provést.'],
            ['Bootstrap se nezobrazí.', 'Zkontrolujte připojení k internetu. Bootstrap je načtený přes CDN.'],
        ];
    }

    public function sources(): array
    {
        return [
            ['OpenAI Developers - Codex use cases', 'https://developers.openai.com/codex/use-cases'],
            ['OpenAI Developers - dokumentace a zdroje', 'https://developers.openai.com/'],
            ['Bootstrap dokumentace', 'https://getbootstrap.com/docs/5.3/getting-started/introduction/'],
            ['Projektová dokumentace OpenAI Codex desktop app', 'Zpracováno pro školní projekt dne 7. 6. 2026'],
        ];
    }
}
