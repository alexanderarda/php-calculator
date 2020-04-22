<?php


namespace Jakmall\Recruitment\Calculator\Services;


use Illuminate\Container\Container;
use Jakmall\Recruitment\Calculator\Models\Operation;

class LoggerService
{

    // save calculation to database and file
    public function save(Operation $data)
    {
        Container::getInstance()->make('file')->append($data);
        Container::getInstance()->make('database')->append($data);
    }

    // get calculation log
    public function get($driver, $commands)
    {
        return Container::getInstance()->make($driver)->list($commands);
    }

    // delete all existing calculation history
    public function delete()
    {
        Container::getInstance()->make('file')->delete();
        Container::getInstance()->make('database')->delete();

        return true;
    }

}
