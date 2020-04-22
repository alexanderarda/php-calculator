<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Jakmall\Recruitment\Calculator\Models\Operation as Model;

class File implements DriverInterface
{

    private const HISTORY_FILE = 'calculator.txt';

    public function list($commands)
    {

        $list = [];

        if (file_exists(self::HISTORY_FILE)) {
            $fn = fopen(self::HISTORY_FILE,"r");

            if(empty($commands)){

                while(! feof($fn))  {
                    $list [] = explode('|',fgets($fn));
                }

            }else{

                $commands = array_map('strtolower', $commands);

                while(! feof($fn))  {

                    $row = explode('|',fgets($fn));
                    if(in_array(strtolower($row[0]), $commands)){
                        $list [] = $row;
                    }
                }

            }

            fclose($fn);

            return $list;
        }

        return ['history is empty'];
    }

    public function append(Model $model)
    {

        $txt = sprintf("%s|%s|%s|%s", $model->getName(), $model->getDescription(), $model->getTotal(), $model->getResult());

        file_put_contents(self::HISTORY_FILE, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

    }

    public function delete()
    {
        if (file_exists(self::HISTORY_FILE)) {
            rmdir(self::HISTORY_FILE);
        }
    }
}
