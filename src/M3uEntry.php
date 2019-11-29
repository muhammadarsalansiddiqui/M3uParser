<?php

namespace M3uParser;

use M3uParser\Tag\ExtTagInterface;

class M3uEntry
{
    /**
     * @var string
     */
    protected $lineDelimiter = "\n";
    /**
     * @var ExtTagInterface[]
     */
    private $extTags = [];
    /**
     * @var string|null
     */
    private $path;

    /**
     * @return ExtTagInterface[]
     */
    public function getExtTags(): array
    {
        return $this->extTags;
    }

    /**
     * @param ExtTagInterface $extTag
     * @return $this
     */
    public function addExtTag(ExtTagInterface $extTag): self
    {
        $this->extTags[] = $extTag;
        return $this;
    }
    
    /**
     * Remove all previously defined tags
     *
     * @return $this
     */
    public function clearExtTags(): self
    {
        $this->extTags = [];
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $out = '';
        foreach ($this->getExtTags() as $extTag) {
            $out .= $extTag . $this->lineDelimiter;
        }

        $out .= $this->getPath();

        return \rtrim($out);
    }
}
