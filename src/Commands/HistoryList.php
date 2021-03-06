<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Services\LoggerService;

class HistoryList extends Command
{

    protected $logger;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history:list {commands?*} {--driver=database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all calculation history';

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

        $commands = $this->argument('commands');
        $storageList = $this->logger->get($this->option('driver'), $commands);

        if(empty($storageList)){
            $this->info('History is empty');
        } else {
            $headers = ['Command', 'Description', 'Result', 'Output'];
            $this->table($headers, $storageList);
        }


    }

}
