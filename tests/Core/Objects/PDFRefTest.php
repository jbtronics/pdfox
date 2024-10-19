<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFRef;
use PHPUnit\Framework\TestCase;

class PDFRefTest extends TestCase
{
    public function testGetGenerationNumber(): void
    {
        $ref = PDFRef::for(42);
        $this->assertEquals(0, $ref->getGenerationNumber());

        $ref = PDFRef::for(42, 1);
        $this->assertEquals(1, $ref->getGenerationNumber());
    }

    public function testGetObjectNumber(): void
    {
        $ref = PDFRef::for(42);
        $this->assertEquals(42, $ref->getObjectNumber());
    }

    public function testToBytes()
    {
        $ref = PDFRef::for(42);
        $this->assertEquals("42 0 R", $ref->toBytes());
        $this->assertEquals(6, $ref->bytesLength());

        $ref = PDFRef::for(42, 1);
        $this->assertEquals("42 1 R", $ref->toBytes());
        $this->assertEquals(6, $ref->bytesLength());
    }
}
