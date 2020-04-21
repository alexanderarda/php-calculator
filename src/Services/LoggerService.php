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

    public function get($driver)
    {
        Container::getInstance()->make($driver)->list();
    }
}
