<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Jakmall\Recruitment\Calculator\Services\AddOperationService;
use Jakmall\Recruitment\Calculator\Services\LoggerService;

class AddOperation extends AbstractCommand
{
    protected $operationSymbol = "+";
    protected $operationName = "Add";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add {numbers?* : The numbers to be added} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add all given Numbers';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct(
        AddOperationService $operation,
        LoggerService $logger
    )
    {
        parent::__construct($logger);
        $this->math = $operation;
    }

}
