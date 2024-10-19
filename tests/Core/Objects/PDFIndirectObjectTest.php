<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFBool;
use Jbtronics\PDFox\Core\Objects\PDFIndirectObject;
use PHPUnit\Framework\TestCase;

class PDFIndirectObjectTest extends TestCase
{

    public function testGetObject(): void
    {
        $indirect = PDFIndirectObject::of(PDFBool::false());
        $this->assertEquals(PDFBool::false(), $indirect->getObject());
    }

    public function testGetObjectNumber(): void
    {
        $indirect = PDFIndirectObject::of(PDFBool::false(), 42);
        $this->assertEquals(42, $indirect->getObjectNumber());
        $this->assertEquals(0, $indirect->getGenerationNumber());
        $indirect->setObjectNumber(43);
        $this->assertEquals(43, $indirect->getObjectNumber());
    }


    public function testGetGenerationNumber(): void
    {
        $indirect = PDFIndirectObject::of(PDFBool::false(), 42, 0);
        $this->assertEquals(0, $indirect->getGenerationNumber());
        $indirect->setGenerationNumber(1);
        $this->assertEquals(1, $indirect->getGenerationNumber());
    }

    public function testToBytes(): void
    {
        $indirect = PDFIndirectObject::of(PDFBool::false(), 42, 0);
        $this->assertEquals("42 0 obj\nfalse\nendobj", $indirect->toBytes());
    }


}
