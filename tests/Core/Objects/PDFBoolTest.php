<?php

namespace JBtronics\PDFox\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFBool;
use PHPUnit\Framework\TestCase;

class PDFBoolTest extends TestCase
{

    public function testOf(): void
    {
        $true = PDFBool::of(true);
        $this->assertTrue($true->asBool());
        //Must be the same instance as the one returned by true()
        $this->assertSame($true, PDFBool::true());

        $false = PDFBool::of(false);
        $this->assertFalse($false->asBool());
        //Must be the same instance as the one returned by false()
        $this->assertSame($false, PDFBool::false());
    }

    public function testAsBool(): void
    {
        $true = PDFBool::true();
        $this->assertTrue($true->asBool());

        $false = PDFBool::false();
        $this->assertFalse($false->asBool());
    }

    public function testTrue(): void
    {
        $true = PDFBool::true();
        $this->assertTrue($true->asBool());

        //Must return the same instance on consecutive calls
        $this->assertSame($true, PDFBool::true());
    }

    public function testFalse(): void
    {
        $false = PDFBool::false();
        $this->assertFalse($false->asBool());

        //Must return the same instance on consecutive calls
        $this->assertSame($false, PDFBool::false());
    }


    public function testToBytes(): void
    {
        $this->assertSame('true', PDFBool::true()->toBytes());
        $this->assertSame('false', PDFBool::false()->toBytes());
    }

    public function testBytesLength(): void
    {
        $this->assertSame(4, PDFBool::true()->bytesLength());
        $this->assertSame(5, PDFBool::false()->bytesLength());
    }


}
