<?php

declare(strict_types=1);

final class PageBuilder
{
    public function __construct(
        private readonly ContentRepository $content,
        private readonly SectionRenderer $renderer
    ) {
    }

    public function build(): string
    {
        $page = '';
        $page .= $this->navigation();
        $page .= $this->renderer->renderSections($this->content->sections());
        $page .= $this->copyablePrompts();
        $page .= $this->troubleshooting();
        $page .= $this->sources();

        return $page;
    }

    private function navigation(): string
    {
        $html = '<nav class="card shadow-sm border-0 mb-4 guide-toc"><div class="card-body p-4 p-lg-5">';
        $html .= '<h2 class="h3 text-primary-emphasis mb-3">Obsah návodu</h2>';
        $html .= '<p class="text-secondary">Kliknutím na název kapitoly se přesunete na příslušnou část stránky.</p>';
        $html .= '<ol class="list-group list-group-numbered">';

        foreach ($this->content->sections() as $section) {
            $html .= '<li class="list-group-item d-flex align-items-start">';
            $html .= '<a class="text-decoration-none fw-semibold" href="#' . Html::e($section['id']) . '">' . Html::e($this->titleWithoutNumber($section['title'])) . '</a>';
            $html .= '</li>';
        }

        $html .= '<li class="list-group-item d-flex align-items-start"><a class="text-decoration-none fw-semibold" href="#prompty">Kopírovatelné prompty pro Codex</a></li>';
        $html .= '<li class="list-group-item d-flex align-items-start"><a class="text-decoration-none fw-semibold" href="#problemy">Časté problémy a řešení</a></li>';
        $html .= '<li class="list-group-item d-flex align-items-start"><a class="text-decoration-none fw-semibold" href="#zdroje">Použité zdroje</a></li>';
        $html .= '</ol></div></nav>';

        return $html;
    }

    private function titleWithoutNumber(string $title): string
    {
        return preg_replace('/^\d+\.\s*/', '', $title) ?? $title;
    }

    private function copyablePrompts(): string
    {
        $html = '<section class="card shadow-sm border-0 mb-4" id="prompty"><div class="card-body p-4 p-lg-5">';
        $html .= '<h2 class="h3 text-primary-emphasis mb-3">18. Kopírovatelné prompty pro Codex</h2>';
        $html .= '<p class="text-secondary">Tyto prompty můžete rovnou zkopírovat do Codexu.</p>';

        foreach ($this->content->commands() as [$label, $code]) {
            $html .= $this->renderer->renderCommand($label, $code);
        }

        return $html . '</div></section>';
    }

    private function troubleshooting(): string
    {
        return '<section class="card shadow-sm border-0 mb-4" id="problemy"><div class="card-body p-4 p-lg-5">'
            . '<h2 class="h3 text-primary-emphasis mb-3">19. Časté problémy a řešení</h2>'
            . $this->renderer->renderTable(['Problém', 'Řešení'], $this->content->troubleshooting())
            . '</div></section>';
    }

    private function sources(): string
    {
        $html = '<section class="card shadow-sm border-0 mb-4" id="zdroje"><div class="card-body p-4 p-lg-5">';
        $html .= '<h2 class="h3 text-primary-emphasis mb-3">20. Použité zdroje</h2><ul class="mb-0">';

        foreach ($this->content->sources() as [$name, $url]) {
            $html .= '<li class="mb-2">' . Html::e($name) . ': ' . Html::e($url) . '</li>';
        }

        return $html . '</ul></div></section>';
    }
}
