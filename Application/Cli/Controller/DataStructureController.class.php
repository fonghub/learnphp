<?php


namespace Cli\Controller;


use Task\Bll\DataStructure\Bubble;
use Task\Bll\DataStructure\Insert;
use Task\Bll\DataStructure\Select;
use Think\Controller;

class DataStructureController extends Controller
{

    public $arr = array();
    public $res = array();

    public function __construct()
    {
        $this->arr = [6,4,7,2,9,8,1];
        echo "第0轮排序：".json_encode($this->arr)."\n";
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
        $this->res = Bubble::index1($this->arr);
    }

    /*
     * 选择排序
     */
    public function select()
    {
        $this->res = Select::index($this->arr);
    }

    /*
     * 插入排序
     */
    public function insert()
    {
        $this->res = Insert::index($this->arr);
    }


    public function __destruct()
    {
        print_r($this->res);
    }
}