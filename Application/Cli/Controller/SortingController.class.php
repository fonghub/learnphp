<?php


namespace Cli\Controller;


use Task\Bll\DataStructure\Bubble;
use Task\Bll\DataStructure\Insert;
use Task\Bll\DataStructure\MaxHeap1;
use Task\Bll\DataStructure\SearchTree;
use Task\Bll\DataStructure\Select;
use Think\Controller;
/*
 * 排序类
 */
class SortingController extends Controller
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

    /*
     * 利用树排序
     */
    public function tree()
    {
        $data = array_shift($this->arr);
        $tree = new SearchTree($data);
        foreach ($this->arr as $value){
            SearchTree::insert($tree,new SearchTree($value));
        }
        $tree->minOrder($tree);
        echo "\n";
    }

    /*
     * 堆排序
     */
    public function heap()
    {
        $mh1 = new MaxHeap1($this->arr);
        $this->res = $mh1->sort();
        $this->res = array_reverse($this->res);
    }

    public function __destruct()
    {
        print_r($this->res);
    }
}