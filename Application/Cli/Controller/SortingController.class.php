<?php
namespace Cli\Controller;



use Task\Bll\Algorithm\Sorting\Bubble;
use Task\Bll\Algorithm\Sorting\Insert;
use Task\Bll\Algorithm\Sorting\MaxHeap;
use Task\Bll\Algorithm\Sorting\MergeSort;
use Task\Bll\Algorithm\Sorting\Quick;
use Task\Bll\Algorithm\Sorting\Select;
use Task\Bll\Algorithm\Sorting\Tree;
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
        $this->res = Bubble::index($this->arr);
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
        $tree = new Tree($data);
        foreach ($this->arr as $value){
            Tree::insert($tree,new Tree($value));
        }
        $this->res = $tree->minOrder($tree);
    }

    /*
     * 堆排序
     */
    public function heap()
    {
        $mh1 = new MaxHeap($this->arr);
        $this->res = $mh1->sort();
        $this->res = array_reverse($this->res);
    }

    /*
     * 快速排序
     */
    public function quick()
    {
        $this->res = Quick::index($this->arr);
    }

    /*
    *归并排序
    */
    public function merge()
	{
        $this->res = MergeSort::sort($this->arr);
    }
    
    public function __destruct()
    {
        print_r($this->res);
    }
}