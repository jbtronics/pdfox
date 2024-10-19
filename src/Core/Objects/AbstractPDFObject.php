<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

abstract class AbstractPDFObject implements PDFObjectInterface
{

    abstract public function toBytes(): string;

    public function bytesLength(): int
    {
        return strlen($this->toBytes());
    }
}