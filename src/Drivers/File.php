<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Illuminate\Support\Str;
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

                    $row = str_replace(array("\n", "\r"), '', fgets($fn));

                    if(Str::length($row) > 0)
                        $list [] = explode('|',$row);

                }

            }else{

                $commands = array_map('strtolower', $commands);

                while(! feof($fn))  {

                    $row = str_replace(array("\n", "\r"), '', fgets($fn));
                    $arrRow = explode('|',$row);

                    if(in_array(strtolower($arrRow[0]), $commands)){
                        if(Str::length($row) > 0)
                            $list [] = $arrRow;
                    }
                }

            }

            fclose($fn);


        }
        return $list;
    }

    public function append(Model $model)
    {

        $txt = sprintf("%s|%s|%s|%s", $model->getName(), $model->getDescription(), $model->getTotal(), $model->getResult());

        file_put_contents(self::HISTORY_FILE, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

    }

    public function delete()
    {
        if (file_exists(self::HISTORY_FILE)) {
            $fh = fopen( self::HISTORY_FILE, 'w' );
            fclose($fh);
        }
    }
}
