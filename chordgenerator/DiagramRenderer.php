<?php
class DiagramRenderer {
    public function drawDiagram($chordName, $vPref, $borrowed) {
        // Získat frets z VoicingManager
        $frets = [/* frets */];
        $dc = $borrowed ? '#9b7fe8' : '#E8B84B';
        $svg = '<svg width="62" height="76" xmlns="http://www.w3.org/2000/svg">';
        $svg .= '<title>Diagram pro ' . $chordName . '</title>'; // Přidáno pro čitelnost
        // Přidat popisky strun
        for ($i = 0; $i < 6; $i++) {
            $svg .= '<text x="' . (9 + $i * 9) . '" y="10" font-size="8" fill="#777" text-anchor="middle">' . (6 - $i) . '</text>';
        }
        // Kreslit pražce a noty s lepšími popisky
        // ... (rozvinout logiku z původního JS, přidat čísla pražců)
        $svg .= '</svg>';
        return ['svg' => $svg, 'voicingStr' => implode('', array_map(fn($f) => $f < 0 ? 'x' : $f, $frets))];
    }
}
?>