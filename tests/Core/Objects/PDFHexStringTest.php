<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFHexString;
use Jbtronics\PDFox\Core\Objects\PDFString;
use PHPUnit\Framework\TestCase;

class PDFHexStringTest extends TestCase
{

    public function testAsString(): void
    {
        $hexString = PDFHexString::of('Hello, World!');
        $this->assertEquals('Hello, World!', $hexString->asString());
    }

    public function testEquals()
    {
        $hexString1 = PDFHexString::of('Hello, World!');
        $hexString2 = PDFHexString::of('Hello, World!');
        $this->assertTrue($hexString1->equals($hexString2));

        $hexString3 = PDFHexString::of('Hello, World');
        $this->assertFalse($hexString1->equals($hexString3));

        $pdfString = PDFString::of('Hello, World!');
        $this->assertTrue($hexString1->equals($pdfString));
    }

    public function testToBytes()
    {
        $hexString = PDFHexString::of('Hello, World!');
        $this->assertEquals('<48656c6c6f2c20576f726c6421>', $hexString->toBytes());
        $this->assertEquals(strlen('<48656c6c6f2c20576f726c6421>'), $hexString->bytesLength());
    }
}
