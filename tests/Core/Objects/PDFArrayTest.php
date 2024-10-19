<?php

namespace JBtronics\PDFox\Tests\Core\Objects;

use Jbtronics\PDFox\Core\Objects\PDFArray;
use Jbtronics\PDFox\Core\Objects\PDFBool;
use Jbtronics\PDFox\Core\Objects\PDFName;
use Jbtronics\PDFox\Core\Objects\PDFNull;
use Jbtronics\PDFox\Core\Objects\PDFNumber;
use Jbtronics\PDFox\Core\Objects\PDFString;
use PHPUnit\Framework\TestCase;

class PDFArrayTest extends TestCase
{

    public function testAsArray(): void
    {
        $phparray = [PDFString::of("Hello"), PDFString::of("World"), PDFBool::true()];
        $array = PDFArray::of($phparray);
        $this->assertEquals($phparray, $array->asArray());
    }

    public function testGet()
    {
        $phparray = [PDFString::of("Hello"), PDFString::of("World"), PDFBool::true()];
        $array = PDFArray::of($phparray);

        $this->assertEquals(PDFString::of("Hello"), $array->get(0));
        $this->assertEquals(PDFString::of("World"), $array->get(1));

        //Access should also be possible via the ArrayAccess interface
        $this->assertEquals(PDFString::of("Hello"), $array[0]);
        $this->assertEquals(PDFString::of("World"), $array[1]);
    }

    public function testSet()
    {
        $phparray = [PDFString::of("Hello"), PDFString::of("World"), PDFBool::true()];
        $array = PDFArray::of($phparray);
        $array->set(0, PDFString::of("Hi"));

        $this->assertEquals(PDFString::of("Hi"), $array->get(0));
        $this->assertEquals(PDFString::of("World"), $array->get(1));

        //Setting should also be possible via the ArrayAccess interface
        $array[1] = PDFString::of("Earth");
        $this->assertEquals(PDFString::of("Earth"), $array[1]);
    }

    public function testAdd()
    {
        $phparray = [PDFString::of("Hello"), PDFString::of("World"), PDFBool::true()];
        $array = PDFArray::of($phparray);
        $array->add(PDFString::of("Hi"));

        $this->assertEquals(PDFString::of("Hi"), $array->get(3));
    }

    public static function toBytesDataProvider(): array
    {
        return [
            ["[549 3.14 false (Test) /SomeName]", [PDFNumber::of(549), PDFNumber::of(3.14), PDFBool::false(),
                PDFString::of("Test"), PDFName::of("SomeName")]],
            //Nested arrays
            ["[[true] 3.14 [123 [null]]]", [PDFArray::of([PDFBool::true()]), PDFNumber::of(3.14),
                PDFArray::of([PDFNumber::of(123), PDFArray::of([PDFNull::instance()])])]],
        ];
    }

    /**
     * @dataProvider toBytesDataProvider
     */
    public function testToBytes(string $expected, array $data): void
    {
        $array = PDFArray::of($data);
        $this->assertSame($expected, $array->toBytes());
        $this->assertSame(strlen($expected), $array->bytesLength());
    }
}
