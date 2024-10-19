<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Structures;

/**
 * This class offers methods to convert PDF objects to their string representation
 */
class ObjectWriter
{
    public function toBoolean(bool $value): string
    {
        return $value ? 'true' : 'false';
    }

    public function toInteger(int $value): string
    {
        return (string) $value;
    }

    public function toReal(float $value): string
    {
        return (string) $value;
    }

    public function toName(string $value): string
    {
        return '/' . $value;
    }

    public function toString(string $value): string
    {
        //Escape special characters
        $value = str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $value);

        return '(' . $value . ')';
    }
}