<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents the base functionality for a PDF dictionary object.
 * The subclasses then implement different access types for the dictionary contents.
 */
abstract class AbstractPDFDict extends AbstractPDFObject
{
    /**
     * Generates a normalized representation of the dictionary contents, which gets used for the output.
     * @return \Iterator<string, PDFObjectInterface>|array<string, PDFObjectInterface>
     */
    abstract protected function generateContents(): \Iterator|array;

    public function toBytes(): string
    {
        $bytes = "<<\n";

        foreach ($this->generateContents() as $key => $value) {
            $bytes .= PDFName::of($key)->toBytes() . ' ' . $value->toBytes() . "\n";
        }

        return $bytes . ">>";
    }
}