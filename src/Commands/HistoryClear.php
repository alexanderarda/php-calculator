<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Services\LoggerService;

class HistoryClear extends Command
{

    protected $logger;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all calculation history';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LoggerService $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->logger->delete()){
            $this->info("Calculation history has been cleared");
        }
    }
}
