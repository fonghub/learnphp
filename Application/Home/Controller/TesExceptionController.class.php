<?php


namespace Home\Controller;


use Task\Bll\Exception\TesException;
use Think\Exception;

class TesExceptionController
{

    public function index()
    {
        echo 'TesExceptionController';
    }

    public function tes($num)
    {
        try{
            if ($num > 1)
                throw new TesException('num gt 1');
            echo $num;
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}