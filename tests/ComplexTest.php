<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Complex;

class ComplexTest extends TestCase
{

    /**
     * @dataProvider  additionProvider
     */
    public function testAddition(Complex $a, Complex $b, $expected): void
    {
        $this->assertEquals($expected, $a->addition($b));
    }

    public function additionProvider()
    {
        return [
            [
                Complex::algebraic(28.04, -1.56),
                Complex::algebraic(20, 10),
                Complex::algebraic(48.04, 8.44),
            ],
            [
                Complex::trigonometric(2, pi()),
                Complex::trigonometric(4, pi()/2 ),
                Complex::trigonometric(sqrt(20), pi() + atan(-2)),
            ],
        ];
    }

    /**
     * @dataProvider subtractionProvider
     */
    public function testSubtraction(Complex $a, Complex $b, $expected): void
    {

        $this->assertEquals($expected, $a->subtraction($b));
    }

    public function subtractionProvider()
    {
        return [
            [
                Complex::algebraic(28.04, -1.56),
                Complex::algebraic(20, 10),
                Complex::algebraic(8.04, -11.56),
            ],
            [
                Complex::trigonometric(2, pi()),
                Complex::trigonometric(4, pi()/2 ),
                Complex::trigonometric(sqrt(20), pi() + atan(2)),
            ],
        ];
    }

    /**
     * @dataProvider multiplicationProvider
     */
    public function testMultiplication(Complex $a, Complex $b, $expected): void
    {
        $this->assertEquals($expected, $a->multiplication($b));
    }

    public function multiplicationProvider()
    {
        return [
            [
                Complex::algebraic(28.04, -1.56),
                Complex::algebraic(20, 10),
                Complex::algebraic(576.4, 249.2),
            ],
            [
                Complex::trigonometric(2, pi()),
                Complex::trigonometric(4, pi()/2 ),
                Complex::trigonometric(8, 3* pi()/2),
            ],
        ];
    }

    /**
     * @dataProvider divisionProvider
     */
    public function testDivision(Complex $a, Complex $b, $expected): void
    {
        $this->assertEquals($expected, $a->division($b));
    }

    public function divisionProvider()
    {
        return [
            [
                Complex::algebraic(28.04, -1.56),
                Complex::algebraic(20, 10),
                Complex::algebraic(1.0904, -0.6232),
            ],
            [
                Complex::algebraic(-2, 0),
                Complex::algebraic(0, 4),
                Complex::algebraic(0, 0.5),
            ],
            [
                Complex::trigonometric(2, pi()),
                Complex::trigonometric(4, pi()/2 ),
                Complex::trigonometric(0.5,pi()/2),
            ],
        ];
    }

    public function testDivisionByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $number = Complex::algebraic(28.04, -1.56);
        $number->division(Complex::algebraic(0,0));
    }

    /**
     * @dataProvider stringProvider
     */
    public function testToString(Complex $a, $expected): void
    {
        $this->assertEquals($expected, (string)$a);
    }

    public function stringProvider()
    {
        return [
            [Complex::algebraic(28.04, -1.56), '28.04 - 1.56i'],
            [Complex::algebraic(20, 10), '20 + 10i'],
            [Complex::trigonometric(2, pi()), '2(cos(Pi + argtg(0)) + i*sin(Pi + argtg(0)))'],
            [Complex::trigonometric(4, pi()/2 ), '4(cos(Pi/2) + i*sin(Pi/2))'],
            [Complex::trigonometric(pi(), pi()/3, 3), '3.142(cos(argtg(1.732)) + i*sin(argtg(1.732)))'],
        ];
    }

}