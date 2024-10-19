<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

class PDFHexString extends AbstractPDFObject
{
    private function __construct(protected readonly string $value)
    {
    }

    public static function of(string $value): self
    {
        return new self($value);
    }

    /**
     * Returns the string value
     * @return string
     */
    public function asString(): string
    {
        return $this->value;
    }

    /**
     * Compare the string value with another PDFString object (bytewise comparison).
     */
    public function equals(PDFString|PDFHexString $other): bool
    {
        return $this->asString() === $other->asString();
    }

    public function toBytes(): string
    {
        //Convert the binary string to a hexadecimal string and surround it with angle brackets
        return '<' . bin2hex($this->value) . '>';
    }
}