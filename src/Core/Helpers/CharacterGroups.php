<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Helpers;

/**
 * A helper class to help identify special characters for the PDF format.
 */
final class CharacterGroups
{
    public const WHITESPACES = ["\x00", "\x09", "\x0A", "\x0C", "\x0D", "\x20"];
    public const WHITESPACE_REGEX_GROUP = " [\x00\x09\x0A\x0C\x0D\x20]";

    public const DELIMITERS = ["(", ")", "<", ">", "[", "]", "{", "}", "/", "%"];
    public const DELIMITER_REGEX_GROUP = '[\(\)<>\[\]\{\}\/%]';

    public const NON_REGULAR_REGEX_GROUP = '[\(\)<>\[\]\{\}\/%\x00\x09\x0A\x0C\x0D\x20]';

    /**
     * Checks if a character is a whitespace character.
     * @param  string  $char
     * @return bool
     */
    public static function isWhitespace(string $char): bool
    {
        if (strlen($char) !== 1) {
            throw new \InvalidArgumentException("The input must be a single character.");
        }

        return in_array($char, self::WHITESPACES);
    }

    /**
     * Checks if a character is a delimiter character.
     * @param  string  $char
     * @return bool
     */
    public static function isDelimiter(string $char): bool
    {
        if (strlen($char) !== 1) {
            throw new \InvalidArgumentException("The input must be a single character.");
        }

        return in_array($char, self::DELIMITERS);
    }

    /**
     * Checks if a character is a regular character.
     * @param  string  $char
     * @return bool
     */
    public static function isRegularCharacter(string $char): bool
    {
        if (strlen($char) !== 1) {
            throw new \InvalidArgumentException("The input must be a single character.");
        }

        return !self::isWhitespace($char) && !self::isDelimter($char);
    }
}