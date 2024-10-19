<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents the immutable PDF null object.
 */
class PDFNull extends AbstractPDFObject
{
    private static ?self $instance = null;

    private function __construct()
    {

    }

    public function toBytes(): string
    {
        return 'null';
    }

    public function bytesLength(): int
    {
        return 4;
    }

    /**
     * Returns the single instance of the PDF null object.
     * @return self
     */
    public static function instance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}