<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Jakmall\Recruitment\Calculator\Services\LoggerService;
use Jakmall\Recruitment\Calculator\Services\MultiplyOperationService;

class MultiplyOperation extends AbstractCommand
{

    protected $operationSymbol = "*";
    protected $operationName = "Multiply";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multiply {numbers*} The numbers to be multiplied';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Multiply all given Numbers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( MultiplyOperationService $operation, LoggerService $logger) {
        parent::__construct($logger);
        $this->math = $operation;
    }

    public function validate($arguments) {

        if (count($arguments) < 2) {
            $this->error('The number or operand must be 2 or more');
            return false;
        }

        return true;
    }

}
