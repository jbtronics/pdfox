<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFDict;
use Jbtronics\PDFox\Core\Objects\PDFName;
use Jbtronics\PDFox\Core\Objects\PDFNumber;
use Jbtronics\PDFox\Core\Objects\PDFString;
use PHPUnit\Framework\TestCase;

class PDFDictTest extends TestCase
{
    public function testAsArray(): void
    {
        $phpArray = [
            'key1' => PDFNumber::of(42),
            'key2' => PDFString::of('Hello'),
        ];

        $dict = PDFDict::of($phpArray);
        $this->assertEquals($phpArray, $dict->asArray());
    }

    public function testKeys(): void
    {
        $phpArray = [
            'key1' => PDFNumber::of(42),
            'key2' => PDFString::of('Hello'),
        ];

        $dict = PDFDict::of($phpArray);

        $this->assertEquals(['key1', 'key2'], $dict->keys());
    }

    public static function toBytesDataProvider(): array
    {
        return [
            //Basic test
            [
                <<<DICT
                <<
                /Type /Example
                /Subtype /Dictionary
                /Version 0.01
                >>
                DICT,
                [
                    'Type' => PDFName::of('Example'),
                    'Subtype' => PDFName::of('Dictionary'),
                    'Version' => PDFNumber::of(0.01),
                ]
            ],
        ];
    }

    /**
     * @dataProvider toBytesDataProvider
     */
    public function testToBytes(string $expected, array $data): void
    {
        //Normalize line endings in expected output
        $expected = str_replace("\r\n", "\n", $expected);

        $array = PDFDict::of($data);
        $this->assertSame($expected, $array->toBytes());
        $this->assertSame(strlen($expected), $array->bytesLength());
    }




}
