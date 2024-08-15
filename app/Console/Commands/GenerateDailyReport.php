<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\LaporanHarianController;

class GenerateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily report';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $controller = new LaporanHarianController();
        $controller->generateSeluruh();

        $this->info('Daily report generated successfully!');
    }
}
