<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

use Traversable;

/**
 * This class represents a generic PDF dictionary object, which can be used to store key-value pairs and can be
 * easily accessed and manipulated from outside.
 */
class PDFDict extends AbstractPDFDict implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @param  array<string, PDFObjectInterface>  $values
     */
    protected function __construct(protected array $values)
    {
    }

    public static function of(array $values): self
    {
        return new self($values);
    }

    /**
     * Returns the given elements as an PHP array of PDF objects.
     * @return array<string, PDFObjectInterface>
     */
    public function asArray(): array
    {
        return $this->values;
    }

    /**
     * Returns the keys of the dictionary.
     * @return string[]
     */
    public function keys(): array
    {
        return array_keys($this->values);
    }


    protected function generateContents(): \Iterator|array
    {
        return $this->values;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet(mixed $offset): PDFObjectInterface
    {
        return $this->values[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_string($offset)) {
            throw new \InvalidArgumentException("The key must be a string.");
        }
        if (!$value instanceof PDFObjectInterface) {
            throw new \InvalidArgumentException("The value must be a PDF object.");
        }

        $this->values[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->values[$offset]);
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->values);
    }
}