<?php

declare(strict_types=1);

final class Layout
{
    public function render(string $title, string $subtitle, string $content): string
    {
        return '<!doctype html>'
            . '<html lang="cs">'
            . '<head>'
            . '<meta charset="utf-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>' . Html::e($title) . '</title>'
            . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">'
            . '<style>.guide-toc .list-group-item::before{margin-right:.55rem;min-width:1.75rem;color:var(--bs-secondary-color);}.guide-toc .list-group-item{gap:.25rem;}</style>'
            . '</head>'
            . '<body class="bg-body-tertiary">'
            . $this->renderHeader($title, $subtitle)
            . '<main class="container py-4" id="guide-content">' . $content . '</main>'
            . '<footer class="container pb-5 text-secondary">Návod lze stáhnout, zkopírovat nebo vytisknout do PDF. Screenshoty uložte do složky assets/screenshots pod názvy použité v návodu.</footer>'
            . '<script src="assets/app.js"></script>'
            . '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>'
            . '</body></html>';
    }

    private function renderHeader(string $title, string $subtitle): string
    {
        return '<header class="bg-white border-bottom">'
            . '<div class="container py-5">'
            . '<h1 class="display-5 fw-bold mb-3">' . Html::e($title) . '</h1>'
            . '<p class="lead text-secondary col-lg-9">' . Html::e($subtitle) . '</p>'
            . '<div class="d-flex flex-wrap gap-2 mt-4">'
            . '<button class="btn btn-primary" type="button" id="copy-guide">Kopírovat celý návod</button>'
            . '<a class="btn btn-outline-primary" href="download.php">Stáhnout HTML</a>'
            . '<button class="btn btn-outline-secondary" type="button" onclick="window.print()">Tisk / PDF</button>'
            . '</div>'
            . '</div></header>';
    }
}
