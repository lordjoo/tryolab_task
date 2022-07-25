<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FixStudentsOrder extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $command = $this->artisan("fix:students-order");
        $command->expectsOutputToContain("Students order fixed.");
        $command->assertExitCode(0);

    }
}
