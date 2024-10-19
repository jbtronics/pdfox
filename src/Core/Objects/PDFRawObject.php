<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * An immutable PDF object that just contains a raw byte sequence, that will be outputted as is.
 */
class PDFRawObject extends AbstractPDFObject
{
    private function __construct(protected readonly string $value)
    {
    }

    public static function of(string $value): self
    {
        return new self($value);
    }

    public function asBytes(): string
    {
        return $this->value;
    }

    public function toBytes(): string
    {
        return $this->value;
    }
}