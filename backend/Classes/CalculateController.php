<?php

namespace Classes;

use Classes\Calculator;
use Classes\Helper;

class CalculateController
{
    public function processInstructions($filename, $dirname)
    {
        $filePath = $dirname . "/" . $filename;

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            unlink($filePath);
            return Helper::response("error", null, 400, "Unable to read the file.");
        }

        $lastLine = end($lines);
        $lastLineParts = explode(' ', $lastLine);
        $applyValue = $lastLineParts[1];
        $isLastLineApply = strtolower($lastLineParts[0]) === 'apply';

        if (!is_numeric($applyValue)) {
            return Helper::response("error", null, 422, "'apply' value must be a number.");
        }

        if ($isLastLineApply) {
            $applyNumber = $lastLineParts[1];
            $calculator = new Calculator($applyNumber);

            foreach ($lines as $line) {
                $parts = explode(' ', $line);

                if (count($parts) !== 2) {
                    // unlink($filePath);
                    return Helper::response("error", null, 422, "Invalid instruction format - '$line'.");
                }

                [$keyword, $number] = $parts;

                if (!is_numeric($number)) {
                    // unlink($filePath);
                    return Helper::response("error", null, 400, "Invalid value, only numbers are allowed.");
                }

                $keyword = strtolower($keyword);
                $number = floatval($number);

                if ($keyword === 'apply') {
                    // unlink($filePath);
                    return Helper::response("success", $calculator->getResult(), 200);
                } else {
                    $result = $calculator->applyOperation($keyword, $number);

                    // Check if applyOperation returned something
                    if ($result !== null) {
                        // unlink($filePath);
                        return $result;
                    }
                }
            }
        } else {
            // unlink($filePath);
            return Helper::response("error", null, 422, "'apply' instruction not found at the last of instructions.");
        }
    }
}
