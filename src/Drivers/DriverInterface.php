<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Jakmall\Recruitment\Calculator\Models\Operation as Model;

interface DriverInterface
{
    public function list();
    public function append(Model $model);
    public function delete();
}
