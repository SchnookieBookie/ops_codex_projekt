<?php
class AudioPlayer {
    const RPRESETS = [
        '4/4' => [1, 0, 0, 0, 1, 0, 0, 0],
        // ...
    ];

    public function getRhythmPresets() { return self::RPRESETS; }

    // Metody pro audio, ale přehrávání zůstává v JS
}
?>