<?php


namespace App;


class TrigonometricComplex extends Complex
{
    public $round;

    public function __construct($real, $imaginary, $round = 5)
    {
        parent::__construct($real, $imaginary);
        $this->round = $round;
    }

    public function __toString(): string
    {
        // модуль для формулы
        $module = sqrt($this->real ** 2 + $this->imaginary ** 2);

        // значение угла фи
        $fi = $this->getFi();

        return sprintf('%s(cos(%s) + i*sin(%s))', round($module, $this->round), $fi, $fi);

    }

    /**
     * Получение значения угла фи
     * @param float $x
     * @param float $y
     * @return string
     */
    private function getFi(): string
    {
        $x = $this->real;
        $y = $this->imaginary;

        if ($x > 0)
        {
            return sprintf('argtg(%s)', round($y / $x, $this->round));
        }
        elseif ($x < 0 && $y >= 0)
        {
            return sprintf('Pi + argtg(%s)', round($y / $x, $this->round));
        }
        elseif ($x < 0 && $y < 0)
        {
            return sprintf('-Pi + argtg(%s)', round($y / $x, $this->round));
        }
        elseif ($x == 0 && $y > 0)
        {
            return 'Pi/2';
        }
        // остается последний вариант ($x == 0 && $y < 0)
        else
        {
            return '- Pi/2';
        }
    }
}