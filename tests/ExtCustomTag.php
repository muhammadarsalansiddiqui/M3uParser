<?php

namespace M3uParser\Tests;

use M3uParser\Tag\ExtTagInterface;

class ExtCustomTag implements ExtTagInterface
{
    /**
     * @var string
     */
    private $data;

    /**
     * #EXTCUSTOMTAG:data
     * @param string $lineStr
     */
    public function __construct(?string $lineStr = null)
    {
        if (null !== $lineStr) {
            $this->makeData($lineStr);
        }
    }

    /**
     * @param string $lineStr
     */
    protected function makeData(string $lineStr): void
    {
        /*
EXTCUSTOMTAG format:
#EXTCUSTOMTAG:data
example:
#EXTCUSTOMTAG:123
         */

        $data = \substr($lineStr, \strlen('#EXTCUSTOMTAG:'));

        $this->setData(\trim($data));
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function setData(string $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '#EXTCUSTOMTAG: ' . $this->getData();
    }

    /**
     * @param string $lineStr
     * @return bool
     */
    public static function isMatch(string $lineStr): bool
    {
        return 0 === \stripos($lineStr, '#EXTCUSTOMTAG:');
    }
}
