<?php 
namespace App\Service;

class CalculatorService
{
    public function calculate(float $a, float $b, string $operation): float
    {
        switch ($operation) {
            case 'add':
                return $a + $b;
            case 'subtract':
                return $a - $b;
            case 'multiply':
                return $a * $b;
            case 'divide':
                if ($b == 0) {
                    throw new \InvalidArgumentException("Division by zero is not allowed.");
                }
                return $a / $b;
            default:
                throw new \InvalidArgumentException("Invalid operation.");
        }
    }
}
