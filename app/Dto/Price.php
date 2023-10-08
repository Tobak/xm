<?php

namespace App\Dto;

class Price
{
 private int $date;
 private ?float $open;
 private ?float $high;
 private ?float $low;
 private ?float $close;
 private ?int $volume;
 private ?float $adjclose;

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): Price
    {
        $this->date = $date;
        return $this;
    }

    public function getOpen(): ?float
    {
        return $this->open;
    }

    public function setOpen(?float $open): Price
    {
        $this->open = $open;
        return $this;
    }

    public function getHigh(): ?float
    {
        return $this->high;
    }

    public function setHigh(?float $high): Price
    {
        $this->high = $high;
        return $this;
    }

    public function getLow(): ?float
    {
        return $this->low;
    }

    public function setLow(?float $low): Price
    {
        $this->low = $low;
        return $this;
    }

    public function getClose(): ?float
    {
        return $this->close;
    }

    public function setClose(?float $close): Price
    {
        $this->close = $close;
        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): Price
    {
        $this->volume = $volume;
        return $this;
    }

    public function getAdjclose(): ?float
    {
        return $this->adjclose;
    }

    public function setAdjclose(?float $adjclose): Price
    {
        $this->adjclose = $adjclose;
        return $this;
    }

}
