<?php

declare(strict_types=1);

require_once __DIR__ . '/classes/Html.php';
require_once __DIR__ . '/classes/ContentRepository.php';
require_once __DIR__ . '/classes/SectionRenderer.php';
require_once __DIR__ . '/classes/PageBuilder.php';
require_once __DIR__ . '/classes/Layout.php';

$content = new ContentRepository();
$renderer = new SectionRenderer($content->screenshots());
$page = (new PageBuilder($content, $renderer))->build();
$html = (new Layout())->render($content->title(), $content->subtitle(), $page);

header('Content-Type: text/html; charset=UTF-8');
header('Content-Disposition: attachment; filename="navod-codex-features.html"');
echo $html;
