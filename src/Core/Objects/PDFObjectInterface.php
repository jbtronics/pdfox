<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

interface PDFObjectInterface
{
    /**
     * Returns this PDF object as a string of bytes.
     * @return string
     */
    public function toBytes(): string;

    /**
     * Returns the length of the byte string returned by toBytes().
     * @return int
     */
    public function bytesLength(): int;
}