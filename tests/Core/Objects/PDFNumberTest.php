<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFNumber;
use PHPUnit\Framework\TestCase;

class PDFNumberTest extends TestCase
{

    public function testAsInt()
    {
        $number = PDFNumber::of(42);
        $this->assertSame(42, $number->asNumber());

        $number = PDFNumber::of(-42);
        $this->assertSame(-42, $number->asNumber());

        $number = PDFNumber::of(42.42);
        $this->assertSame(42.42, $number->asNumber());

    }

    public function testToBytes(): void
    {
        $number = PDFNumber::of(42);
        $this->assertSame('42', $number->toBytes());
        $this->assertSame(2, $number->bytesLength());

        $number = PDFNumber::of(0);
        $this->assertSame('0', $number->toBytes());
        $this->assertSame(1, $number->bytesLength());

        $number = PDFNumber::of(-42);
        $this->assertSame('-42', $number->toBytes());
        $this->assertSame(3, $number->bytesLength());

        $number = PDFNumber::of(42.42);
        $this->assertSame('42.42', $number->toBytes());
        $this->assertSame(5, $number->bytesLength());

        $number = PDFNumber::of(-42.42);
        $this->assertSame('-42.42', $number->toBytes());
        $this->assertSame(6, $number->bytesLength());
    }

    public function testEquals(): void
    {
        $number1 = PDFNumber::of(42);
        $number2 = PDFNumber::of(42);
        $this->assertTrue($number1->equals($number2));

        $number1 = PDFNumber::of(42);
        $number2 = PDFNumber::of(43);
        $this->assertFalse($number1->equals($number2));
    }


}
