<?php

declare(strict_types=1);

namespace App;

use DivisionByZeroError;

/**
 * Class Complex
 * @package App
 */
class Complex
{
    
    private $real;

    private $imaginary;

    public function __construct($real, $imaginary)
    {
        if (!is_numeric($real)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Недопустимый тип "%s" значения действительной части. Допустимые типы "%s".',
                    gettype($real),
                    'int,float,string number'
                )
            );
        }

        if (!is_numeric($imaginary)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Недопустимый тип "%s" значения мнимой части. Допустимые типы "%s".',
                    gettype($imaginary),
                    'int,float,string number'
                )
            );
        }

        $this->real      = (float)$real;
        $this->imaginary = (float)$imaginary;
    }

    public function real(): float
    {
        return $this->real;
    }

    public function imaginary(): float
    {
        return $this->imaginary;
    }

    public function __toString(): string
    {
        $sign = $this->imaginary < 0 ? '-' : '+';

        return sprintf('%s %s %si', $this->real, $sign, abs($this->imaginary));
    }

    /**
     * Сложение
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function addition(Complex $a, Complex $b): Complex
    {
        $new_real = $a->real() + $b->real();
        $new_imaginary = $a->imaginary() + $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Вычитание
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function subtraction(Complex $a, Complex $b): Complex
    {
        $new_real = $a->real() - $b->real();
        $new_imaginary = $a->imaginary() - $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Умножение
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function multiplication(Complex $a, Complex $b): Complex
    {
        $new_real = $a->real() * $b->real() - $a->imaginary() * $b->imaginary();
        $new_imaginary = $a->imaginary() * $b->real() + $a->real() * $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Деление
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function division(Complex $a, Complex $b): Complex
    {
        if ($b->real() == 0 && $b->imaginary() == 0) {
            throw new DivisionByZeroError('Division by zero');
        }

        $divisor = $b->real() ** 2 + $b->imaginary() ** 2;
        $new_real = ($a->real() * $b->real() + $a->imaginary() * $b->imaginary()) / $divisor;
        $new_imaginary = ($a->imaginary() * $b->real() - $a->real() * $b->imaginary()) / $divisor;

        return new static($new_real, $new_imaginary);
    }

}