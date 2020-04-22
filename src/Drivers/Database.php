<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;
use Jakmall\Recruitment\Calculator\Models\Operation as Model;

class Database implements DriverInterface
{

    public function list($commands)
    {

        $list = [];

        $query = Capsule::table('history')
            ->select('command','description','result','output');

        if(!empty($commands))
            $query = $query->whereIn('command', $commands);

        $result = $query->get();

        foreach ($result as $idx => $storage){
            $list[] = array($storage->command,$storage->description,$storage->result,$storage->output);
        }

        return $list;

    }

    public function append(Model $model)
    {

        return Capsule::insert('INSERT INTO history (command,description,result,output) VALUES (:command,:description,:result,:output)',
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
