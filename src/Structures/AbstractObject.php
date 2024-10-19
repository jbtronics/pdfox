<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Structures;

/**
 * An abstract class that is used as base for all kind of PDF objects
 */
abstract class AbstractObject
{

    /**
     * @var int|null The object number of this object in the PDF document
     */
    protected ?int $objectNumber = null;

    /**
     * @var string|null The type of the object
     */
    protected ?string $type = null;

    /**
     * @var string|null The subtype of the object
     */
    protected ?string $subtype = null;

    public function setObjectNumber(int $objectNumber): self
    {
        $this->objectNumber = $objectNumber;
        return $this;
    }

    /**
     * @return int The object number of this object in the PDF document
     */
    public function getObjectNumber(): int
    {
        if ($this->objectNumber === null) {
            throw new \LogicException('The object number must be set before it can be retrieved.');
        }

        return $this->objectNumber;
    }

    /**
     * @return string The type of this object as the type key in a dictionary
     */
    public function getType(): string
    {
        if ($this->type === null) {
            throw new \LogicException('The type of the object must be overwritten in subclasses.');
        }

        return $this->type;
    }
}