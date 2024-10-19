<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

use Traversable;

/**
 * Represents an immutable PDF array object.
 */
class PDFArray extends AbstractPDFObject implements \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
     * @param  array<int, PDFObjectInterface>  $elements
     */
    private function __construct(protected array $elements)
    {
    }

    public static function of(array $elements): self
    {
        return new self($elements);
    }

    /**
     * Returns the given elements as an PHP array of PDF objects.
     * @return array<int, PDFObjectInterface>
     */
    public function asArray(): array
    {
        return $this->elements;
    }

    /**
     * Adds the given element to the end of the array.
     * @param  PDFObjectInterface  $element
     * @return void
     */
    public function add(PDFObjectInterface $element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Get the element with the given index.
     * @param  int  $index
     * @return PDFObjectInterface
     */
    public function get(int $index): PDFObjectInterface
    {
        return $this->elements[$index];
    }

    /**
     * Set the element with the given index
     * @param  int  $index
     * @param  PDFObjectInterface  $element
     * @return void
     */
    public function set(int $index, PDFObjectInterface $element): void
    {
        //Ensure that we do not create holes in the indices
        if ($index < 0 || $index >= count($this->elements)) {
            throw new \InvalidArgumentException("Index out of bounds.");
        }
        $this->elements[$index] = $element;
    }

    public function toBytes(): string
    {
        return "[".implode(' ',
                array_map(fn(AbstractPDFObject $element) => $element->toBytes(), $this->elements))."]";
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->elements[$offset]);
    }

    public function offsetGet(mixed $offset): PDFObjectInterface
    {
        return $this->elements[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_int($offset)) {
            throw new \InvalidArgumentException('Array keys must be integers');
        }
        if (!$value instanceof PDFObjectInterface) {
            throw new \InvalidArgumentException('Array values must be instances of PDFObjectInterface');
        }

        $this->elements[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->elements[$offset]);
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->elements);
    }
}