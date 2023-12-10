<?php

namespace Tests\Unit;

use Classes\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;
    protected function setUp(): void
    {
        parent::setUp();

        $this->calculator = new Calculator(0);
    }

    /** @test **/
    public function does_it_handle_invalid_operators()
    {
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "Unknown operator 'aaa'"
        ]);

        $this->assertEquals($expected, $this->calculator->applyOperation('aaa', 9));
    }

    /** @test **/
    public function does_it_calculalte_correctly()
    {
        $this->calculator->applyOperation('subtract', 3);
        $this->calculator->applyOperation('multiply', 5);
        $this->calculator->applyOperation('divide', 3);
        $this->calculator->applyOperation('multiply', -5);

        $expected = 25;

        $this->assertEquals($expected, $this->calculator->getResult());
    }
}
