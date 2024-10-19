<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Structures;

class ProcedureSet extends AbstractObject
{
    /** @var string[] The default procedure set that should be loaded for backwards compatibility reasons
     * according to ISO 32000-1:2008 (table 314 - Predefined Procedure Sets)
     */
    public const DEFAULT_PROCSET = [
        'PDF',
        'Text',
        'ImageB',
        'ImageC',
        'ImageI'
    ];

    protected ?string $type = 'ProcSet';

    /**
     * @var string[] A list of names of procedures that are used in the PDF document
     */
    protected array $entries = [];

    /**
     * Creates a new ProcedureSet object.
     * @param  array  $entries
     */
    public function __construct(array $entries = self::DEFAULT_PROCSET)
    {
        $this->entries = $entries;
    }

    /**
     * Returns the list of entries
     * @return string[]|null
     */
    public function getEntries(): ?array
    {
        return $this->entries;
    }

    public function addEntry(string $entry): void
    {
        $this->entries[] = $entry;
    }

    public function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }
}