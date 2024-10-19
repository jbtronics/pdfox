<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents a PDF reference object, where the target id is known at creation time.
 */
class PDFRef extends AbstractPDFRef
{

    protected function __construct(protected readonly int $objectNumber, protected readonly int $generationNumber)
    {
    }

    public static function for(int $objectNumber, int $generationNumber = 0): self
    {
        return new self($objectNumber, $generationNumber);
    }

    public function getObjectNumber(): int
    {
        return $this->objectNumber;
    }

    public function getGenerationNumber(): int
    {
        return $this->generationNumber;
    }
}