<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

use Jbtronics\PDFox\Core\Helpers\CharacterGroups;

/**
 * Represents a PDF name object (prefixed by a slash)
 */
class PDFName extends AbstractPDFObject
{
    /**
     * @var array<string, \WeakReference<PDFName>> The cache of PDF name objects
     */
    protected static array $cache = [];

    /**
     * @var string The name of the object as a human-readable text-representation (without slash and any escaping)
     */
    protected string $nameAsText;

    /**
     * @var null|string The name of the object as a PDF-encoded string (with slash and escaping)
     */
    protected ?string $encodedName = null;

    private function __construct(protected string $name)
    {
        $this->nameAsText = $name;
    }

    /**
     * Returns a PDF name object representing the given name (in unescaped form, and without slash)
     * @param  string  $name
     * @return self
     */
    public static function of(string $name): self
    {
        //Check if we already have an instance of the given name
        if (isset(self::$cache[$name]) && ($cached = self::$cache[$name]->get()) !== null) {
            return $cached;
        }

        //Create a new instance and store it in the cache
        $tmp = new self($name);
        self::$cache[$name] = \WeakReference::create($tmp);
        return $tmp;
    }

    /**
     * Returns the name of the object as a human-readable text-representation (without slash and any escaping)
     * @return string
     */
    public function asString(): string
    {
        return $this->nameAsText;
    }

    public function toBytes(): string
    {
        if ($this->encodedName === null) {
            $this->encodedName = '/' . $this->escapeName($this->nameAsText);
        }

        return $this->encodedName;
    }

    /**
     * Returns the name of the object as escaped string, where all special chars were converted to their hex representation
     * @param  string  $name
     * @return string
     */
    protected function escapeName(string $name): string
    {
        //Replace all characters outside 33-126 ASCII range with #xx hex representation
        return preg_replace_callback('/([^!-~]|' . CharacterGroups::DELIMITER_REGEX_GROUP .  ')/', function ($matches) {
            return '#' . strtoupper(dechex(ord($matches[0])));
        }, $name);
    }
}