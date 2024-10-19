<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

abstract class AbstractPDFStream extends AbstractPDFObject
{
    protected PDFDict $options;

    /**
     * Returns the stream content.
     * @return string
     */
    abstract public function getContent(): string;

    /**
     * Returns the length of the stream content.
     * @return int
     */
    abstract public function getContentLength(): int;

    public function toBytes(): string
    {
        //Set the length of the stream content
        $this->options['Length'] = PDFNumber::of($this->getContentLength());

        return $this->options->toBytes() . "\nstream\n" . $this->getContent() . "\nendstream";
    }

}