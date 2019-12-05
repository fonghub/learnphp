<?php
namespace Home\Controller;
class TesHookController
{
    public function index()
    {
        echo "index<br>";
        tag("test_tag");
        B('Home\Behavior\Anotherbhav','test_tag');
        // \Home\Behavior\Anotherbhav::test_tag();
    }


    public function show()
    {
        $res = \Think\Hook::get();
        print_r($res);
    }

    public function num()
    {
        static $a = 1;
        static $a = 2;
        static $a = 3;
        echo $a;
    }


    public function m()
    {
        $name = abc_def;
        $res = parse_name($name, 1);
        echo $res;
    }

    public function env()
    {
        echo PHP_SAPI."<br>";
        echo PHP_OS."<br>";
    }
}