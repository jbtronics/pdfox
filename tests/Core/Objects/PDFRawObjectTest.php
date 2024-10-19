<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFRawObject;
use PHPUnit\Framework\TestCase;

class PDFRawObjectTest extends TestCase
{

    public function testAsBytes(): void
    {
        $rawObject = PDFRawObject::of('Hello, World!');
        $this->assertEquals('Hello, World!', $rawObject->asBytes());
    }

    public function testToBytes(): void
    {
        $rawObject = PDFRawObject::of('Hello, World!');
        $this->assertEquals('Hello, World!', $rawObject->toBytes());
        $this->assertEquals(strlen('Hello, World!'), $rawObject->bytesLength());
    }
}
