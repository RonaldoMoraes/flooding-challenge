<?php
namespace App;

class Matrix {

    public $data;
    private $width;
    private $heights;
    private $maxHeight;
    private $totalFlooding;

    public function __construct(int $width, array $heights)
    {
        $this->data = [];
        $this->width = $width;
        $this->heights = $heights;
        $this->maxHeight = max($heights);
        $this->totalFlooding = 0;
    }

    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function setHeights($heights): void
    {
        $this->heights = $heights;
    }

    public function setMaxHeight($maxHeight): void
    {
        $this->maxHeight = $maxHeight;
    }

    public function getMaxHeight(): int
    {
        return $this->maxHeight;
    }

    public function getHeights(): array
    {
        return $this->heights;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getTotalFlooding(): int
    {
        return $this->totalFlooding;
    }

    public function increaseTotalFlooding(int $count): void
    {
        $this->totalFlooding += $count;
    }

    public function isValid(): bool
    {
        if (count($this->heights) === $this->width) return true;

        $err = json_encode($this->heights);
        echo "Line $err length differs from it's index $this->width. Skipping this one.\n";
        return false;
    }
}