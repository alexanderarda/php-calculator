<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Illuminate\Database\Capsule\Manager as Capsule;
use Jakmall\Recruitment\Calculator\Models\Operation as Model;

class Database implements DriverInterface
{

    public function list()
    {

        // TODO: Implement list() method.

    }

    public function append(Model $model)
    {

        Capsule::insert('INSERT INTO history (command,description,result,output) VALUES (:command,:description,:result,:output)',
            [
                'command' => $model->getName(),
                'description' => $model->getDescription(),
                'result' => $model->getResult(),
                'output' => $model->getTotal(),
            ]
        );
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
