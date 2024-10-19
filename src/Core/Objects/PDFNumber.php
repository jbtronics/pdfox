<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents an immutable PDF number object.
 */
class PDFNumber extends AbstractPDFObject
{
    private function __construct(protected readonly int $value)
    {
    }

    /**
     * Returns the value of the number as int
     * @return int
     */
    public function asInt(): int
    {
        return $this->value;
    }

    public function toBytes(): string
    {
        return (string) $this->value;
    }

    /**
     * Create a new PDF number object with the given value
     * @param  int  $value
     * @return self
     */
    public static function of(int $value): self
    {
        return new self($value);
    }

    /**
     * @param  PDFNumber  $number
     * @return bool
     */
    public function equals(PDFNumber $number): bool
    {
        return $this->value === $number->value;
    }
}