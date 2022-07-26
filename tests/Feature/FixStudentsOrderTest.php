<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FixStudentsOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fix_order_command_ends_with_zero()
    {
        $command = $this->artisan("fix:students-order");
        $command->expectsOutputToContain("Students order fixed.");
        $command->assertExitCode(0);
    }

}
