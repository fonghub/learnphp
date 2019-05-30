<?php


namespace Home\Controller;


use Think\Controller;

class TesController extends Controller
{

    public function index()
    {
//        self::index2();
        $t2 = new Tes2Controller();
//        echo "location=".$t2->location."<br>";
//        echo "name=".Tes2Controller::$name."<br>";

//        echo "location=".Tes2Controller::$location."<br>";
        echo "name=".$t2->name."<br>";
    }

    public static function index2()
    {
        $className = __NAMESPACE__.'\Tes2Controller';
        $t2 = new $className;
//        $t2->index3();
//        Tes2Controller::index2();
//        Tes2Controller::index3();
//        $t2->index3();

        call_user_func_array(array($className,'index2'),array());
//        call_user_func_array(array($t2,'index3'),array());
    }

}