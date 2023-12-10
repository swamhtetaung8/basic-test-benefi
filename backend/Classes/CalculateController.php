<?php

namespace Classes;

use Classes\Calculator;
use Classes\Helper;

class CalculateController
{
    public function processInstructions($filename)
    {
        $filePath = UPLOAD_DIR . "/" . $filename;

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            unlink($filePath);
            Helper::response("error", null, 400, "Unable to read the file.");
            return;
        }

        $lastLine = end($lines);
        $lastLineParts = explode(' ', $lastLine);
        $isLastLineApply = strtolower($lastLineParts[0]) === 'apply';

        if ($isLastLineApply) {
            $applyNumber = $lastLineParts[1];
            $calculator = new Calculator($applyNumber);

            foreach ($lines as $line) {
                $parts = explode(' ', $line);

                if (count($parts) != 2) {
                    unlink($filePath);
                    Helper::response("error", null, 422, "Invalid instruction format - '$line'.");
                    break;
                }

                [$keyword, $number] = $parts;

                $keyword = strtolower($keyword);
                $number = floatval($number);

                if ($keyword === 'apply') {
                    unlink($filePath);
                    Helper::response("success", $calculator->getResult(), 200);
                } else {
                    $calculator->applyOperation($keyword, $number);
                }
            }
        } else {
            unlink($filePath);
            Helper::response("error", null, 422, "'apply' instruction not found at the last of instructions.");
        }
    }
}
