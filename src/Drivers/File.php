<?php


namespace Jakmall\Recruitment\Calculator\Drivers;


use Jakmall\Recruitment\Calculator\Models\Operation as Model;

class File implements DriverInterface
{

    private const HISTORY_FILE = 'calculator.txt';

    public function list()
    {
        if (file_exists(self::HISTORY_FILE)) {
            $results = [];
            $fn = fopen(self::HISTORY_FILE,"r");

            while(! feof($fn))  {
                $results[] = fgets($fn);
                var_dump(fgets($fn));
            }

            fclose($fn);

            return $results;
        }

        return ['history is empty'];
    }

    public function append(Model $model)
    {

        $txt = sprintf("%s|%s|%s|%s|%s", $model->getName(), $model->getDescription(), $model->getTotal(), $model->getResult(), $model->getTimeStamp());

        file_put_contents(self::HISTORY_FILE, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

    }

    public function delete()
    {
        if (file_exists(self::HISTORY_FILE)) {
            rmdir(self::HISTORY_FILE);
        }
    }
}
