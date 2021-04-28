<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Complex;

class ComplexTest extends TestCase
{
    
    private $numberA;

    private $numberB;

    public function setUp(): void
    {
        $this->numberA = new Complex(28.04, -1.56);
        $this->numberB = new Complex(20, 10);
    }

    public function testAddition(): void
    {
        $numberC = Complex::addition($this->numberA, $this->numberB);
        $this->assertSame((float)48.04, $numberC->real());
        $this->assertSame((float)8.44, $numberC->imaginary());
    }

    public function testSubtraction(): void
    {
        $numberC = Complex::subtraction($this->numberA, $this->numberB);
        $this->assertSame((float)8.04, $numberC->real());
        $this->assertSame((float)-11.56, $numberC->imaginary());
    }

    public function testMultiplication(): void
    {
        $numberC = Complex::multiplication($this->numberA, $this->numberB);
        $this->assertSame((float)576.4, $numberC->real());
        $this->assertSame((float)249.2, $numberC->imaginary());
    }

    public function testDivision(): void
    {
        $numberC = Complex::division($this->numberA, $this->numberB);
        $this->assertSame(1.0904, $numberC->real());
        $this->assertSame(-0.6232, $numberC->imaginary());
    }

    public function testDivisionByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        Complex::division($this->numberA, new Complex(0,0));
    }

}