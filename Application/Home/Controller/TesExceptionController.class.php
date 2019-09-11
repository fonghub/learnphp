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


    public function handlerException()
    {
        $this->userDefinedException();
        throw new Exception("I am Exception<br>");

    }

    public function userDefinedException()
    {
        $myException = function ($exception){
            echo $exception->getMessage();
        };
        set_exception_handler($myException);
    }

    public function handlerError()
    {
        $this->userDefinedError();
        echo $test;
    }

    public function userDefinedError()
    {
        $myError = function ($errno,$errstr,$errfile,$errline){
            $str = <<<EOF
                "errno":$errno
                "errstr":$errstr
                "errfile":$errfile
                "errline":$errline
EOF;
            echo $str;
        };
        set_error_handler($myError);
    }
}