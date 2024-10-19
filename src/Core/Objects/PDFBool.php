<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents an immutable PDF boolean object.
 */
class PDFBool extends AbstractPDFObject
{

    private static ?self $true = null;
    private static ?self $false = null;

    private function __construct(protected readonly bool $value)
    {
    }

    public function asBool(): bool
    {
        return $this->value;
    }

    public function toBytes(): string
    {
        if ($this->value) {
            return 'true';
        }

        return 'false';
    }

    public function bytesLength(): int
    {
        return $this->value ? 4 : 5;
    }

    /**
     * Returns a PDF boolean object representing the given value.
     * @param  bool  $value
     * @return self
     */
    public static function of(bool $value): self
    {
        return $value ? self::true() : self::false();
    }

    /**
     * Returns a PDF boolean object representing the value `true`.
     * @return self
     */
    public static function true(): self
    {
        if (null === self::$true) {
            self::$true = new self(true);
        }
        return self::$true;
    }

    /**
     * Returns a PDF boolean object representing the value `false`.
     * @return self
     */
    public static function false(): self
    {
        if (null === self::$false) {
            self::$false = new self(false);
        }

        return self::$false;
    }
}