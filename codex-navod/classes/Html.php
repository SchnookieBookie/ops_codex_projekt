<?php

declare(strict_types=1);

final class Html
{
    public static function e(string|int|null $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
