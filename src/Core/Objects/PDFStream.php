<?php

declare(strict_types=1);


namespace Jbtronics\PDFox\Core\Objects;

/**
 * Represents a PDF stream object with fixed content.
 */
class PDFStream extends AbstractPDFStream
{

    private function __construct(PDFDict $options, protected string $content)
    {
        $this->options = $options;
    }

    /**
     * Creates a new PDF stream object with the given content and optional options.
     * @param  string  $content
     * @param  PDFDict|null  $options
     * @return self
     */
    public static function of(string $content, ?PDFDict $options = null): self
    {
        return new self($options ?? PDFDict::of([]), $content);
    }


    public function getContent(): string
    {
        return $this->content;
    }

    public function getContentLength(): int
    {
        return strlen($this->content);
    }
}