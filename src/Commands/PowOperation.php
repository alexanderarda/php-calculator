<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Jakmall\Recruitment\Calculator\Models\Operation;
use Jakmall\Recruitment\Calculator\Services\LoggerService;
use Jakmall\Recruitment\Calculator\Services\PowOperationService;

class PowOperation extends AbstractCommand
{
    protected $operationSymbol = "^";
    protected $operationName = "Pow";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pow {base} {exp} Exponent the number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exponent the number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( PowOperationService $operation, LoggerService $logger) {
        parent::__construct($logger);
        $this->math = $operation;
    }


    public function handle()
    {

        $base = $this->argument('base');
        $exp = $this->argument('exp');

        $numbers = array($base, $exp);

        $calculation = new Operation($this->operationSymbol, $this->operationName,$numbers);
        $calculation = $this->math->doOperation($calculation);

        $this->log->save($calculation);

        $this->line($calculation->getResult());

    }

}
