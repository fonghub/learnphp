<?php


namespace Home\Controller;


use Task\Bll\Exception\TesException;

class TesExceptionController
{

    public function index()
    {
        echo 'TesExceptionController';
    }

    public function tes($num)
    {
        try{
            if ($num > 10)
                throw new \LogicException('num gt 10');
            elseif ($num > 9)
                throw new \RuntimeException('num gt 9');
            elseif ($num > 8)
                throw new \OutOfRangeException('num gt 8');
            elseif ($num > 6)
                throw new TesException('num gt 6');
            echo $num;
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}