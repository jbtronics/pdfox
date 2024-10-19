<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents an object that can be referenced indirectly in a PDF file.
 */
interface ReferencableObjectInterface
{
    /**
     * Gets the object number of the indirect object.
     * @return int
     */
    public function getObjectNumber(): int;

    /**
     * Gets the generation number of the indirect object.
     * @return int
     */
    public function getGenerationNumber(): int;
}