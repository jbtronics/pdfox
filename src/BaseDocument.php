<?php

declare(strict_types=1);


namespace Jbtronics\PDFox;

use Jbtronics\DPDF\Structures\AbstractObject;
use Jbtronics\DPDF\Structures\DocumentCatalog;
use Jbtronics\DPDF\Structures\Outlines;
use Jbtronics\DPDF\Structures\Pages;

class BaseDocument
{
    /**
     * A list of all objects that are part of the PDF document, indexed by their object number.
     * @var array<int, AbstractObject>
     */
    protected array $objects = [];

    protected DocumentCatalog $documentCatalog;

    public function __construct()
    {
        //Initialize the basic structures of the PDF document
        $this->documentCatalog = new DocumentCatalog();
        $this->addObj($this->documentCatalog);

        $this->initDocument();
    }

    protected function initDocument(): void
    {
        $outlines = new Outlines();
        $this->addObj($outlines);
        $this->documentCatalog->setOutlines($outlines);

        $pages = new Pages();
        $this->addObj($pages);
        $this->documentCatalog->setPages($pages);
    }

    /**
     * Add the given object to the PDF document and return its object number
     * The object number will be assigned automatically.
     * @param  AbstractObject  $object
     * @return int
     */
    protected function addObj(AbstractObject $object): int
    {
        $objectNumber = count($this->objects) + 1;
        $this->objects[$objectNumber] = $object;
        $object->setObjectNumber($objectNumber);
    }
}