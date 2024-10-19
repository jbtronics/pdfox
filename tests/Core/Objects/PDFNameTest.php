<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFName;
use PHPUnit\Framework\TestCase;

class PDFNameTest extends TestCase
{
    public function testAsString(): void
    {
        $name = PDFName::of('Test');
        $this->assertSame('Test', $name->asString());

        $this->assertSame('This is a 1234 test!~', PDFName::of('This is a 1234 test!~')->asString());
    }


    public function toBytesDataProvider(): array
    {
        return [
            ['/Type', 'Type'],
            ['/1.2', '1.2'],
            ['/$$', '$$'],
            ['/Lime#20Green', 'Lime Green'],
            ['/paired#28#29parentheses', 'paired()parentheses'],
        ];
    }

    /**
     * @dataProvider toBytesDataProvider
     */
    public function testToBytes(string $expected, string $input): void
    {
        $name = PDFName::of($input);
        $this->assertSame($expected, $name->toBytes());
        $this->assertSame(strlen($expected), $name->bytesLength());
    }




}
