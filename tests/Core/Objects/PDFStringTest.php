<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFHexString;
use Jbtronics\PDFox\Core\Objects\PDFString;
use PHPUnit\Framework\TestCase;

class PDFStringTest extends TestCase
{

    public function testAsString(): void
    {
        $pdfString = PDFString::of('Hello, World!');
        $this->assertEquals('Hello, World!', $pdfString->asString());
    }

    public function testEquals()
    {
        $pdfString1 = PDFString::of('Hello, World!');
        $pdfString2 = PDFString::of('Hello, World!');
        $this->assertTrue($pdfString1->equals($pdfString2));

        $pdfString3 = PDFString::of('Hello, World');
        $this->assertFalse($pdfString1->equals($pdfString3));

        $hexString = PDFHexString::of('Hello, World!');
        $this->assertTrue($pdfString1->equals($hexString));
    }

    public function toBytesDataProvider(): array
    {
        return [
            ["(Test)", "Test"],
            ["(Hello World 1234!)", "Hello World 1234!"],
            ['(Escaping\)\( Test \\n)', "Escaping)( Test \n"],
            ['(With non ASCII \303)', "With non ASCII \xC3"],
            ['(\006)', "\x06"]
        ];
    }

    /**
     * @dataProvider toBytesDataProvider
     */
    public function testToBytes(string $expected, string $input): void
    {
        $pdfString = PDFString::of($input);
        $this->assertEquals($expected, $pdfString->toBytes());
        $this->assertEquals(strlen($expected), strlen($pdfString->toBytes()));
    }




}
