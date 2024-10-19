<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents an immutable PDF string object in the literal string encoding (surrounded by parentheses).
 */
class PDFString extends AbstractPDFObject
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

    protected static function escape(string $value): string
    {
        //Replace any non-character ASCII characters or backslash or parenthesis with their escaped versions
        return preg_replace_callback('/[\x00-\x1F\x7F-\xFF\\\\\(\)]/', function($match): string {
            $char = $match[0];
            return match ($char) {
                "\n" => "\\n",
                "\r" => "\\r",
                "\t" =>  "\\t",
                "\b" => "\\b",
                "\f" => "\\f",
                "\\" => "\\\\",
                "(" => "\\(",
                ")" => "\\)",
                default => sprintf("\\%03o", ord($char))
            };
        }, $value);
    }

    public function toBytes(): string
    {
        return '(' . self::escape($this->value) . ')';
    }
}