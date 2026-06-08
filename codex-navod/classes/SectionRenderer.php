<?php

declare(strict_types=1);

final class SectionRenderer
{
    public function __construct(private readonly array $screenshots = [])
    {
    }

    public function renderSections(array $sections): string
    {
        $html = '';

        foreach ($sections as $section) {
            $html .= '<section class="card shadow-sm border-0 mb-4" id="' . Html::e($section['id']) . '">';
            $html .= '<div class="card-body p-4 p-lg-5">';
            $html .= '<h2 class="h3 text-primary-emphasis mb-3">' . Html::e($section['title']) . '</h2>';

            if (isset($section['lead'])) {
                $html .= '<p class="lead fs-6 text-secondary mb-4">' . Html::e($section['lead']) . '</p>';
            }

            foreach ($section['body'] ?? [] as $paragraph) {
                $html .= '<p class="mb-3">' . Html::e($paragraph) . '</p>';
            }

            if (isset($section['steps'])) {
                $html .= '<h3 class="h5 mt-4">Jak použít</h3><ol class="mb-3">';
                foreach ($section['steps'] as $step) {
                    $html .= '<li class="mb-2">' . Html::e($step) . '</li>';
                }
                $html .= '</ol>';
            }

            if (isset($section['list'])) {
                $html .= '<ul class="mb-3">';
                foreach ($section['list'] as $item) {
                    $html .= '<li class="mb-2">' . Html::e($item) . '</li>';
                }
                $html .= '</ul>';
            }

            if (isset($section['cards'])) {
                $html .= '<div class="row g-3 my-3">';
                foreach ($section['cards'] as [$title, $text]) {
                    $html .= '<div class="col-md-6 col-xl-4">';
                    $html .= '<div class="border rounded-3 p-3 h-100 bg-light">';
                    $html .= '<strong class="d-block mb-2">' . Html::e($title) . '</strong>';
                    $html .= '<span>' . Html::e($text) . '</span>';
                    $html .= '</div></div>';
                }
                $html .= '</div>';
            }

            if (isset($section['blocks'])) {
                $html .= '<div class="my-3">';
                foreach ($section['blocks'] as [$title, $text]) {
                    $html .= '<div class="mb-4">';
                    $html .= '<h3 class="h5 fw-bold mb-1">' . Html::e($title) . '</h3>';
                    $html .= '<p class="mb-0 text-secondary">' . Html::e($text) . '</p>';
                    $html .= '</div>';
                }
                $html .= '</div>';
            }

            foreach ($section['commands'] ?? [] as $command) {
                $label = $command['label'] ?? $command[0] ?? 'Ukázka';
                $code = $command['code'] ?? $command[1] ?? '';
                $html .= $this->renderCommand($label, $code);
            }

            if (isset($section['tips'])) {
                $html .= '<div class="alert alert-info mt-4 mb-0"><strong>Praktické poznámky:</strong><ul class="mb-0 mt-2">';
                foreach ($section['tips'] as $tip) {
                    $html .= '<li>' . Html::e($tip) . '</li>';
                }
                $html .= '</ul></div>';
            }

            foreach ($section['screenshots'] ?? [] as $screenshotKey) {
                $html .= $this->renderScreenshot($screenshotKey);
            }

            $html .= '</div></section>';
        }

        return $html;
    }

    public function renderCommand(string $label, string $code): string
    {
        return '<div class="border rounded-3 overflow-hidden my-3">'
            . '<div class="d-flex justify-content-between align-items-center bg-dark text-white px-3 py-2">'
            . '<span>' . Html::e($label) . '</span>'
            . '<button class="btn btn-sm btn-outline-light" type="button" data-copy-code>Kopírovat</button>'
            . '</div>'
            . '<pre class="m-0 p-3 bg-black text-white overflow-auto"><code>' . Html::e($code) . '</code></pre>'
            . '</div>';
    }

    public function renderTable(array $headers, array $rows): string
    {
        $html = '<div class="table-responsive"><table class="table table-bordered align-middle">';
        $html .= '<thead class="table-info"><tr>';
        foreach ($headers as $header) {
            $html .= '<th scope="col">' . Html::e($header) . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        foreach ($rows as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . Html::e($cell) . '</td>';
            }
            $html .= '</tr>';
        }

        return $html . '</tbody></table></div>';
    }

    public function renderScreenshot(string $key): string
    {
        if (!isset($this->screenshots[$key])) {
            return '';
        }

        $shot = $this->screenshots[$key];
        $path = $shot['file'];
        $caption = $shot['caption'];
        $exists = is_file(dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path));

        $html = '<figure class="mt-4 mb-0">';

        if ($exists) {
            $html .= '<img class="img-fluid rounded-3 border shadow-sm" src="' . Html::e($path) . '" alt="' . Html::e($caption) . '">';
        } else {
            $html .= '<div class="border rounded-3 bg-body-secondary text-secondary p-4">';
            $html .= '<strong class="d-block mb-2">Obrázek zatím není vložen</strong>';
            $html .= '<span>Uložte obrázek jako <code>' . Html::e($path) . '</code>.</span>';
            $html .= '</div>';
        }

        $html .= '<figcaption class="small text-secondary mt-2">' . Html::e($caption) . '</figcaption>';
        $html .= '</figure>';

        return $html;
    }
}
