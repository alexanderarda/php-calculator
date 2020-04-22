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
    protected $signature = 'pow {numbers?* } Exponent the number';

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

    public function validate($arguments) {

        if(empty($arguments)){
            $this->error('The number or operand is required for calculation');
            return false;
        }

        if (count($arguments) != 2) {
            $this->error('The number or operand must be <base> and <exp> only');
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

}
