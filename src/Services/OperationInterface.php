<?php


namespace Jakmall\Recruitment\Calculator\Services;


use Jakmall\Recruitment\Calculator\Models\Operation;

interface OperationInterface
{
    public function doOperation(Operation $obj);

}
