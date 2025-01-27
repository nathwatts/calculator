<?php

namespace App\Tests;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function testAddition(): void
    {
        $calculator = new CalculatorService();
        $this->assertEquals(10, $calculator->calculate(5, 5, 'add'));
    }

    public function testDivisionByZero(): void
    {
        $calculator = new CalculatorService();
        $this->expectException(\InvalidArgumentException::class);
        $calculator->calculate(10, 0, 'divide');
    }
}
