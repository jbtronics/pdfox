<?php

namespace JBtronics\PDFox\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFNull;
use PHPUnit\Framework\TestCase;

class PDFNullTest extends TestCase
{

    public function testInstance(): void
    {
        $null = PDFNull::instance();
        //Must return always the same instance
        $this->assertSame($null, PDFNull::instance());
    }

    public function testToBytes(): void
    {
        $null = PDFNull::instance();
        $this->assertSame('null', $null->toBytes());
    }

    public function testBytesLength(): void
    {
        $null = PDFNull::instance();
        $this->assertSame(4, $null->bytesLength());
    }
}
