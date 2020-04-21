<?php


namespace Jakmall\Recruitment\Calculator\Models;


class Operation
{

    protected $name;
    protected $symbol;
    protected $arguments;
    protected $total = 0;
    protected $timestamp;

    public function __construct( $symbol, $name, $arguments ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->arguments = $arguments;
        $this->timestamp = date('Y-m-d h:i:s');
    }

    public function getSymbolDescription()
    {

        $command = "";
        switch ($this->symbol){
            case ($this->symbol == "+") : $command = "Add"; break;
            case ($this->symbol == "-") : $command = "Subtract"; break;
            case ($this->symbol == "/") : $command = "Divide"; break;
            case ($this->symbol == "*") : $command = "Multiply"; break;
            case ($this->symbol == "^") : $command = "Pow"; break;
        }

        return $command;
    }


    public function getArguments()
    {
        return $this->arguments;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        return $this->total = $total;
    }

    public function getTimeStamp()
    {
        return $this->timestamp;
    }

    // need to use php > 7.4.0
    // implode() is deprecated in php 7.4.0
    public function getDescription()
    {
        return implode(  " $this->symbol ", $this->arguments);
    }

    public function getResult()
    {
        return(sprintf("%s = %s", $this->getDescription(), $this->total));
    }
}
