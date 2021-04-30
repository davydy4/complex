<?php


namespace App;


class AlgebraicComplex extends Complex
{
    public function __toString(): string
    {
        $sign = $this->imaginary < 0 ? '-' : '+';

        return sprintf('%s %s %si', $this->real, $sign, abs($this->imaginary));
    }
}