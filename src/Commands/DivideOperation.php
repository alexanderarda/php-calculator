<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Jakmall\Recruitment\Calculator\Services\DivideOperationService;
use Jakmall\Recruitment\Calculator\Services\LoggerService;

class DivideOperation extends AbstractCommand
{
    protected $operationSymbol = "/";
    protected $operationName = "Divide";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'divide {numbers?*} The numbers to be divided';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Divide all given Numbers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( DivideOperationService $operation, LoggerService $logger) {
        parent::__construct($logger);
        $this->math = $operation;
    }


}
