<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Structures;

class DocumentCatalog extends AbstractObject
{
    protected ?string $type = 'Catalog';

    protected ?Outlines $outlines;

    protected ?Pages $pages;

    public function getOutlines(): ?Outlines
    {
        return $this->outlines;
    }

    public function setOutlines(?Outlines $outlines): void
    {
        $this->outlines = $outlines;
    }

    public function getPages(): ?Pages
    {
        return $this->pages;
    }

    public function setPages(?Pages $pages): void
    {
        $this->pages = $pages;
    }


}