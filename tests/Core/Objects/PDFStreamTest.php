<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFDict;
use Jbtronics\PDFox\Core\Objects\PDFStream;
use Jbtronics\PDFox\Core\Objects\PDFString;
use PHPUnit\Framework\TestCase;

class PDFStreamTest extends TestCase
{

    public function testGetContents(): void
    {
        $stream = PDFStream::of('Hello World');

        $this->assertEquals('Hello World', $stream->getContent());
        $this->assertEquals(11, $stream->getContentLength());
    }

    public function testToBytes(): void
    {
        $stream = PDFStream::of('Hello World');

        $this->assertEquals("<<\n/Length 11\n>>\nstream\nHello World\nendstream", $stream->toBytes());

        $stream = PDFStream::of('Hello World', PDFDict::of(['key' => PDFString::of('value')]));
        $this->assertEquals("<<\n/key (value)\n/Length 11\n>>\nstream\nHello World\nendstream", $stream->toBytes());

    }
}
