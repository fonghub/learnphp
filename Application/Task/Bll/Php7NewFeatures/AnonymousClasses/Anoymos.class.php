<?php
namespace Task\Bll\Php7NewFeatures\AnonymousClasses;


class Anoymos implements Logger
{
    public function log(string $msg)
    {
        echo $msg;
    }
}