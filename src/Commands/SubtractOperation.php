<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Jakmall\Recruitment\Calculator\Services\AddOperationService;
use Jakmall\Recruitment\Calculator\Services\LoggerService;
use Jakmall\Recruitment\Calculator\Services\SubtractOperationService;

class SubtractOperation extends AbstractCommand
{
    protected $operationSymbol = "-";
    protected $operationName = "Subtract";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subtract {numbers*} The numbers to be subtracted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subtract all given Numbers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( SubtractOperationService $operation, LoggerService $logger) {
        parent::__construct($logger);
        $this->math = $operation;
    }
    
}
