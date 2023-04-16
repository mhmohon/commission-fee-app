<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\FeeCalculationService;

class FeeCalculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fee-calculate {--path= : Path to the CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $exchangeRates;

    public function __construct(
        protected FeeCalculationService $calculationService
    ){
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $filePath = $this->option('path') ?? $this->askFilePath();
            
            $this->fileValidation($filePath);

            $this->info($this->calculationService->feeCalculate($filePath));
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return;
        }
    }

    public function askFilePath()
    {
        $filePath = $this->ask('Input the CSV file path with transactions to parse');
        if(empty($filePath)){
            $this->error("The program requires the CSV file path. Exiting...");
            exit();
        }
        return $filePath;
    }

    /**
     * @param string $filePath
     * @return void
     */
    public function fileValidation(string $filePath): void
    {
        if(!file_exists($filePath)){
            $this->error("File not found: ". $filePath);
        }
        $handle = fopen($filePath, 'r');
        if(!$handle){
            $this->error('unable to open filePath: '.$filePath);
        }
    }
}
