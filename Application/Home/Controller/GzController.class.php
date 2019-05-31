<?php


namespace Home\Controller;


class GzController extends ChinaController
{
    use GdController;
}

trait GdController
{
    public function sayHello()
    {
        echo "gd<br>";
    }
}

class ChinaController
{
    public function sayHello()
    {
        echo "china<br>";
    }
}