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

    public $real;

    public $imaginary;

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


    /**
     * Сложение
     * @param Complex $b
     * @return Complex
     */
    public function addition(Complex $b): Complex
    {
        $new_real = $this->real() + $b->real();
        $new_imaginary = $this->imaginary() + $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Вычитание
     * @param Complex $b
     * @return Complex
     */
    public function subtraction(Complex $b): Complex
    {
        $new_real = $this->real() - $b->real();
        $new_imaginary = $this->imaginary() - $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Умножение
     * @param Complex $b
     * @return Complex
     */
    public function multiplication(Complex $b): Complex
    {
        $new_real = $this->real() * $b->real() - $this->imaginary() * $b->imaginary();
        $new_imaginary = $this->imaginary() * $b->real() + $this->real() * $b->imaginary();

        return new static($new_real, $new_imaginary);
    }

    /**
     * Деление
     * @param Complex $b
     * @return Complex
     */
    public function division(Complex $b): Complex
    {
        if ($b->real() == 0 && $b->imaginary() == 0) {
            throw new DivisionByZeroError('Division by zero');
        }

        $divisor = $b->real() ** 2 + $b->imaginary() ** 2;
        $new_real = ($this->real() * $b->real() + $this->imaginary() * $b->imaginary()) / $divisor;
        $new_imaginary = ($this->imaginary() * $b->real() - $this->real() * $b->imaginary()) / $divisor;

        return new static($new_real, $new_imaginary);
    }

    /**
     * @param float $real
     * @param float $imaginary
     * @return Complex
     */
    public static function algebraic(float $real, float $imaginary): Complex
    {
        return new AlgebraicComplex($real, $imaginary);
    }

    /** Приведение тригонометрических значений к алгебраическим, добавлен параметр округления $round
     * @param float $module
     * @param float $fi
     * @param int $round
     * @return Complex
     */
    public static function trigonometric(float $module, float $fi, int $round = 5): Complex
    {
        $real = round($module * cos($fi), $round);
        $imaginary = round($module * sin($fi), $round);
        return new TrigonometricComplex($real, $imaginary, $round);
    }

}