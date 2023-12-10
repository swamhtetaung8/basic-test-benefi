<?php

namespace Classes;

class Calculator
{
    private $result;

    public function __construct($initialValue)
    {
        $this->result = $initialValue;
    }

    public function applyOperation($operator, $operand)
    {
        switch ($operator) {
            case 'add':
                $this->result += $operand;
                break;
            case 'subtract':
                $this->result -= $operand;
                break;
            case 'multiply':
                $this->result *= $operand;
                break;
            case 'divide':
                if ($operand != 0) {
                    $this->result /= $operand;
                } else {
                    Helper::response("error", null, 400, "Division by zero is not allowed.");
                }
                break;
            default:
                Helper::response("error", null, 400, "Unknown operator '$operator'");
                break;
        }
    }

    public function getResult()
    {
        return $this->result;
    }
}
