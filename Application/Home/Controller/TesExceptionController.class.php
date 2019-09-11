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