<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\DeferPDFRef;
use Jbtronics\PDFox\Core\Objects\PDFBool;
use Jbtronics\PDFox\Core\Objects\PDFIndirectObject;
use PHPUnit\Framework\TestCase;

class DeferPDFRefTest extends TestCase
{
    public function testGetGenerationNumber(): void
    {
        $obj = PDFIndirectObject::of(PDFBool::false(),  42, 0);
        $ref = DeferPDFRef::for($obj);

        $this->assertEquals(0, $ref->getGenerationNumber());
    }

    public function testGetObjectNumber(): void
    {
        $obj = PDFIndirectObject::of(PDFBool::false(),  42, 0);
        $ref = DeferPDFRef::for($obj);

        $this->assertEquals(42, $ref->getObjectNumber());
    }

    public function testToBytes()
    {
        $obj = PDFIndirectObject::of(PDFBool::false(),  42, 0);
        $ref = DeferPDFRef::for($obj);

        $this->assertEquals("42 0 R", $ref->toBytes());
        $this->assertEquals(6, $ref->bytesLength());
    }
}
