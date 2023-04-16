<?php

namespace Tests\Feature;

use App\Console\Commands\FeeCalculate;
use App\Http\Services\FeeCalculationService;
use Tests\TestCase;

class FeeCalculationCommandTest extends TestCase
{
    
    public function test_the_command()
    {
        $filePath = base_path('input.csv');
        $this->artisan('app:fee-calculate', ['--path' => $filePath])
             ->assertExitCode(0);
    }

    public function test_command_with_invalid_file_path()
    {
        $filePath = base_path('wrong.csv');
        $this->artisan('app:fee-calculate', ['--path' => $filePath])
            ->expectsOutputToContain("File not found")     
            ->assertExitCode(0);
    }

    public function test_command_asking_file_path()
    {
        $filePath = base_path('wrong.csv');
        $this->artisan('app:fee-calculate')
            ->expectsQuestion('Input the CSV file path with transactions to parse', $filePath)
            ->assertExitCode(0);
    }

    // public function test_command_promot_file_path_with_empty()
    // {
    //     $this->artisan('app:fee-calculate')
    //         ->expectsQuestion('Input the CSV file path with transactions to parse', '')
    //         ->expectsOutputToContain('The program requires the CSV file path')
    //         ->assertExitCode(0);
    // }

    public function test_command_with_valid_file()
    {
        $filePath = base_path('input.csv');
        $this->artisan('app:fee-calculate', ['--path' => $filePath])
            ->expectsOutputToContain("3.00")     
            ->assertExitCode(0);
    } 
}
