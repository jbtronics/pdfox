<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents an immutable PDF numeric object. This can either be an integer or a real number (float).
 */
class PDFNumber extends AbstractPDFObject
{
    private function __construct(protected readonly int|float $value)
    {
    }

    /**
     * Returns the value of the number as int
     * @return int|float
     */
    public function asNumber(): int|float
    {
        return $this->value;
    }

    /**
     * @return bool true if the value is an integer
     */
    public function isInteger(): bool
    {
        return is_int($this->value);
    }

    /**
     * @return bool true if the value is a float/real
     */
    public function isNumeric(): bool
    {
        return is_numeric($this->value);
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
    public static function of(int|float $value): self
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