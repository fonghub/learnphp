<?php


namespace Cli\Controller;


use Task\Bll\DataStructure\Bubble;
use Think\Controller;

class DataStructureController extends Controller
{

    public $arr = array();
    public $res = array();

    public function __construct()
    {
        $this->arr = [6,4,3,5,0,7,2,9,8,1];
    }

    public function index()
    {
        echo "index\n";
    }

    /*
     * 冒泡
     */
    public function bubble()
    {
        $this->res = Bubble::index($this->arr);
    }


    public function __destruct()
    {
        print_r($this->res);
    }
}