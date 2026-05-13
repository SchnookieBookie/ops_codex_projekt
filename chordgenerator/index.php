<?php
require_once 'classes/MusicTheory.php';
require_once 'classes/ChordGenerator.php';
require_once 'classes/VoicingManager.php';
require_once 'classes/DiagramRenderer.php';
require_once 'classes/AudioPlayer.php';

// Inicializace tříd
$musicTheory = new MusicTheory();
$chordGenerator = new ChordGenerator($musicTheory);
$voicingManager = new VoicingManager();
$diagramRenderer = new DiagramRenderer();
$audioPlayer = new AudioPlayer();

// Příprava dat pro JS
$modes = json_encode($musicTheory->getModes());
$notes = json_encode($musicTheory->getNotes());
$genreP = json_encode($musicTheory->getGenreP());
$coF = json_encode($musicTheory->getCoFScores());
$romanUp = json_encode($musicTheory->getRomanUp());
$modeQualities = json_encode($musicTheory->getModeQualities());
$vdb = json_encode($voicingManager->getVDB());
$simplify = json_encode($voicingManager->getSimplify());
$tuningPresets = json_encode($voicingManager->getTuningPresets());
$rhythmPresets = json_encode($audioPlayer->getRhythmPresets());
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChordForge v2</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="app">
        <header>
            <div>
                <div class="logo">CHORD<span>FORGE</span><span class="v2tag">v2</span></div>
                <div class="tagline">Advanced Guitar Progression Generator</div>
            </div>
        </header>
        <div class="main-layout">
            <!-- LEFT -->
            <aside>
                <div class="panel">
                    <div class="panel-title">Tónina &amp; Škály</div>
                    <div class="field">
                        <label>Tónina</label>
                        <select id="key">
                            <?php foreach ($musicTheory->getNotes() as $note): ?>
                                <option value="<?php echo $note; ?>" <?php echo $note === 'C' ? 'selected' : ''; ?>><?php echo $note; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Primární škála</label>
                        <select id="mode1">
                            <?php foreach ($musicTheory->getModes() as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo $key === 'minor' ? 'selected' : ''; ?>><?php echo ucfirst(str_replace('_', ' ', $key)); ?> (<?php echo $musicTheory->getModeLabel($key); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Další selecty pro mode2, mode3 podobně -->
                </div>
                <!-- Další panely podobně -->
            </aside>
            <!-- RIGHT -->
            <div class="right-col">
                <!-- Obsah pravého sloupce -->
            </div>
        </div>
    </div>

    <script>
        // Předání dat z PHP do JS
        const PHP_DATA = {
            MODES: <?php echo $modes; ?>,
            NOTES: <?php echo $notes; ?>,
            GENRE_P: <?php echo $genreP; ?>,
            COF_SCORES: <?php echo $coF; ?>,
            ROMAN_UP: <?php echo $romanUp; ?>,
            MODE_QUALITIES: <?php echo $modeQualities; ?>,
            VDB: <?php echo $vdb; ?>,
            SIMPLIFY: <?php echo $simplify; ?>,
            TUNING_PRESETS: <?php echo $tuningPresets; ?>,
            RPRESETS: <?php echo $rhythmPresets; ?>
        };
    </script>
    <script src="assets/script.js"></script>
</body>
</html>