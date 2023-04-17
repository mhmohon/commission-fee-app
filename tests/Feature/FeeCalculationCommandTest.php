<?php

namespace Tests\Feature;

use Tests\TestCase;

class FeeCalculationCommandTest extends TestCase
{
    public function test_the_command()
    {
        $filePath = base_path('input.csv');
        $this->artisan('app:fee-calculate', ['--path' => $filePath])
             ->assertExitCode(0);
    }

    public function test_command_with_valid_file()
    {
        $expectedOutput = "0.60\n3.00\n0.00\n0.06\n1.50\n0.00\n0.70\n0.30\n0.30\n3.00\n0.00\n0.00\n65.80";
        $filePath = base_path('input.csv');
        $this->artisan('app:fee-calculate', ['--path' => $filePath])
            ->expectsOutputToContain($expectedOutput)     
            ->assertExitCode(0);
    }
}
