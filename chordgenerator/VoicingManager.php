<?php
class VoicingManager {
    const VDB = [
        'C' => ['mid' => [-1, 3, 2, 0, 1, 0], 'high' => [-1, 3, 5, 5, 5, 3]],
        // ... celá databáze
    ];
    const SIMPLIFY = [
        'maj9' => 'maj7',
        // ... 
    ];
    const TUNING_PRESETS = [
        'Standard' => ['E4', 'B3', 'G3', 'D3', 'A2', 'E2'],
        // ...
    ];

    public function getVDB() { return self::VDB; }
    public function getSimplify() { return self::SIMPLIFY; }
    public function getTuningPresets() { return self::TUNING_PRESETS; }

    public function getFrets($chordName, $pref) {
        // Logika z getFrets
    }
}
?>