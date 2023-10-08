<?php

namespace App\Dto;

class Price
{
 private int $date;
 private float $open;
 private float $high;
 private float $low;
 private float $close;
 private int $volume;
 private float $adjclose;

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): pprice
    {
        $this->date = $date;
        return $this;
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function setOpen(float $open): pprice
    {
        $this->open = $open;
        return $this;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function setHigh(float $high): pprice
    {
        $this->high = $high;
        return $this;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function setLow(float $low): pprice
    {
        $this->low = $low;
        return $this;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function setClose(float $close): pprice
    {
        $this->close = $close;
        return $this;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): pprice
    {
        $this->volume = $volume;
        return $this;
    }

    public function getAdjclose(): float
    {
        return $this->adjclose;
    }

    public function setAdjclose(float $adjclose): pprice
    {
        $this->adjclose = $adjclose;
        return $this;
    }


}
