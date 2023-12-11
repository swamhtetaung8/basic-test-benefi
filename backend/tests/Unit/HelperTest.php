<?php

namespace Tests\Unit;

use Classes\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{

    /** @test **/
    public function does_json_response_work_correctly()
    {
        $expected = json_encode([
            'status' => "success",
            'data' => 10,
            'message' => null
        ]);
        $this->assertEquals($expected, Helper::response('success', 10));
    }

    /** @test **/
    public function is_folder_create_correctly()
    {
        // Can only be correct if the 'test' folder doesn't exist
        $expected = true;
        $this->assertEquals($expected, Helper::createDestinationDirectory('test'));
    }
}
