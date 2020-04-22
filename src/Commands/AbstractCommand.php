<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Models\Operation;
use Jakmall\Recruitment\Calculator\Services\LoggerService;

class AbstractCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * Store all operation
     *
     */
    protected $log;

    protected $math;

    protected $operationSymbol;

    protected $operationName;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LoggerService $log)
    {
        parent::__construct();
        $this->log = $log;
    }

    public function validate($arguments) {

        if(empty($arguments)){
            $this->error('The number or operand is required for calculation');
            return false;
        }

        if (count($arguments) < 2) {
            $this->error('The number or operand must be 2 or more');
            return false;
        }

        foreach ($arguments as $number){
            if(!is_numeric($number)){
                $this->error('Numeric operand is required');
                return false;
            }
        }

        return true;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        try{

            $numbers = $this->argument('numbers');

            if ($this->validate($numbers)) {

                $calculation = new Operation($this->operationSymbol, $this->operationName, $this->argument('numbers'));
                $calculation = $this->math->doOperation($calculation);

                $this->log->save($calculation);

                $this->line($calculation->getResult());

            }

        }catch (\Throwable $e){
            $this->error("error command handler : ".$e);
        }


    }

}
