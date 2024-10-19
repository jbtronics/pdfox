<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents the base functionality for a PDF reference object. The subclassses then implement different ways, how the
 * reference is resolved.
 */
abstract class AbstractPDFRef extends AbstractPDFObject
{

    /**
     * Gets the object number, this reference points to.
     * @return int
     */
    abstract public function getObjectNumber(): int;

    /**
     * Gets the generation number, this reference points to.
     * @return int
     */
    abstract public function getGenerationNumber(): int;

    public function toBytes(): string
    {
        return $this->getObjectNumber() . ' ' . $this->getGenerationNumber() . ' R';
    }
}