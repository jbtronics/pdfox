<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

class PDFIndirectObject extends AbstractPDFObject implements ReferencableObjectInterface
{

    /**
     * @var int|null The objectNumber of the indirect object, must be set before the object is written to a PDF file.
     */
    protected ?int $objectNumber = null;

    /**
     * @var int|null The generation number of the indirect object, must be set before the object is written to a PDF file.
     */
    protected ?int $generationNumber = null;

    protected function __construct(protected readonly PDFObjectInterface $object)
    {
        if ($this->object instanceof self) {
            throw new \InvalidArgumentException('Indirect objects cannot contain other indirect objects.');
        }
    }

    public static function of(PDFObjectInterface $object, ?int $objectNumber = null, ?int $generationNumber = null): self
    {
        $tmp = new self($object);
        $tmp->objectNumber = $objectNumber;
        $tmp->generationNumber = $generationNumber;
        //Fill in the generation number if it is missing
        if ($objectNumber !== null && $generationNumber === null) {
            $tmp->generationNumber = 0;
        }
        return $tmp;
    }

    /**
     * Returns the object encapsulated by this indirect object.
     * @return PDFObjectInterface
     */
    public function getObject(): PDFObjectInterface
    {
        return $this->object;
    }

    /**
     * Gets the object number of the indirect object.
     * @return int
     */
    public function getObjectNumber(): int
    {
        if ($this->objectNumber === null) {
            throw new \LogicException('The object number must be set before it can be retrieved.');
        }
        return $this->objectNumber;
    }

    /**
     * Gets the generation number of the indirect object.
     * @return int
     */
    public function getGenerationNumber(): int
    {
        if ($this->generationNumber === null) {
            throw new \LogicException('The generation number must be set before it can be retrieved.');
        }

        return $this->generationNumber;
    }

    /**
     * Sets the object number and generation number of the indirect object.
     * @param  int  $objectNumber
     * @param  int  $generationNumber
     * @return $this
     */
    public function setObjectNumber(int $objectNumber): self
    {
        if ($objectNumber < 0) {
            throw new \InvalidArgumentException('The object number must be a positive integer.');
        }

        $this->objectNumber = $objectNumber;

        if ($this->generationNumber === null) {
            $this->generationNumber = 0;
        }

        return $this;
    }

    /**
     * Sets the generation number of the indirect object.
     * @param  int  $generationNumber
     * @return $this
     */
    public function setGenerationNumber(int $generationNumber): self
    {
        if ($generationNumber < 0) {
            throw new \InvalidArgumentException('The generation number must be a positive integer.');
        }

        $this->generationNumber = $generationNumber;

        return $this;
    }

    public function toBytes(): string
    {
        if ($this->objectNumber === null || $this->generationNumber === null) {
            throw new \LogicException('The object number and generation number must be set before the object can be written to a PDF file.');
        }

        return $this->objectNumber . ' ' . $this->generationNumber . " obj\n" . $this->object->toBytes() . "\nendobj";
    }
}