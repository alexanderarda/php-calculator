<?php


namespace Jakmall\Recruitment\Calculator\Services;


use Jakmall\Recruitment\Calculator\Models\Operation;

class PowOperationService implements OperationInterface
{

    public function doOperation(Operation $obj)
    {

        // TODO: Implement doOperation() method.

        $numbers = $obj->getArguments();

        foreach ($numbers as $idx => $number){
            if($idx == 0)
                $obj->setTotal($number);
            else
                $obj->setTotal(pow($obj->getTotal(),$number));
        }

        return $obj;

    }

}
