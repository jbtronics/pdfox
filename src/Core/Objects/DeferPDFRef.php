<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents a PDF reference object pointing to an referencable object, whose object number and generation number
 * are resolved at the time of output generation.
 */
class DeferPDFRef extends AbstractPDFRef
{
    protected function __construct(protected readonly ReferencableObjectInterface $object)
    {
    }

    /**
     * Creates a new PDF reference object for the given object.
     * @param  ReferencableObjectInterface  $object
     * @return self
     */
    public static function for(ReferencableObjectInterface $object): self
    {
        return new self($object);
    }

    public function getObjectNumber(): int
    {
        return $this->object->getObjectNumber();
    }

    public function getGenerationNumber(): int
    {
        return $this->object->getGenerationNumber();
    }
}