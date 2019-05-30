<?php


namespace Home\Controller;


use Think\Controller;

class Tes2Controller extends Controller
{
    public static $name='jp';
    public $location = 'dl';

    public function index()
    {
//        self::index3();
//        $this->index3();
//        self::index3();
//        $this->index2();
//        self::index2();
//        echo "name=".self::$name."<br>";
//        echo "location=".$this->location."<br>";

//        echo "name=".$this->name."<br>";
//        echo "location=".self::$location."<br>";
        $this->index2();
    }

    public static function index2()
    {
        echo "静态类方法<br>";
        $t2 = new self();
        echo $t2->location."<br>";
        echo self::$name."<br>";
    }

    public function index3()
    {
        echo "非静态类方法<br>";
        echo $this->location."<br>";
        echo self::$name."<br>";
    }
}