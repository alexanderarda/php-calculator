<?php


namespace Jakmall\Recruitment\Calculator\Services;


use Jakmall\Recruitment\Calculator\Models\Operation;

class AddOperationService implements OperationInterface
{

    public function doOperation(Operation $obj)
    {

        // TODO: Implement doOperation() method.

        $numbers = $obj->getArguments();

        foreach ($numbers as $number){
            $obj->setTotal($obj->getTotal() + $number);
        }

        return $obj;

    }
}
