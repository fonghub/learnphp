<?php

namespace Task\Bll\Exception;

use Think\Exception;
use Throwable;

class TesException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}