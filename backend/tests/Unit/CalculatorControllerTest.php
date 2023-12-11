<?php

namespace Tests\Unit;

use Classes\CalculateController;
use PHPUnit\Framework\TestCase;

class CalculatorControllerTest extends TestCase
{
    private CalculateController $calculateController;
    protected function setUp(): void
    {
        parent::setUp();

        $this->calculateController = new CalculateController();
    }
    /** @test **/
    public function is_instructions_valid()
    {
        $test = $this->calculateController->processInstructions("instruction1.txt", "test-instructions");
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "Invalid instruction format - 'Multiply 3 3'."
        ]);

        $this->assertEquals($expected, $test);
    }

    /** @test **/
    public function is_instructions_value_numbers()
    {
        $test = $this->calculateController->processInstructions("instruction2.txt", "test-instructions");
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "Invalid value, only numbers are allowed."
        ]);

        $this->assertEquals($expected, $test);
    }

    /** @test **/
    public function is_apply_keyword_a_number()
    {
        $test = $this->calculateController->processInstructions("instruction3.txt", "test-instructions");
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "'apply' value must be a number."
        ]);

        $this->assertEquals($expected, $test);
    }

    /** @test **/
    public function is_apply_instruction_at_the_end()
    {
        $test = $this->calculateController->processInstructions("instruction4.txt", "test-instructions");
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "'apply' instruction not found at the last of instructions."
        ]);

        $this->assertEquals($expected, $test);
    }

    /** @test **/
    public function does_it_handle_invalid_operators_from_instruction()
    {
        $test = $this->calculateController->processInstructions("instruction6.txt", "test-instructions");
        $expected = json_encode([
            'status' => "error",
            'data' => null,
            'message' => "Unknown operator 'mad'."
        ]);

        $this->assertEquals($expected, $test);
    }

    /** @test **/
    public function does_it_calculate_correctly()
    {
        $test = $this->calculateController->processInstructions("instruction5.txt", "test-instructions");
        $expected = json_encode([
            'status' => "success",
            'data' => 10,
            'message' => null
        ]);

        $this->assertEquals($expected, $test);
    }
}
