<?php


namespace Cli\Controller;


use Task\Bll\Algorithm\Search\BS;
use Task\Bll\Algorithm\Search\SearchTree;

class SearchController
{
    public $arr = array();
    public $res = array();

    public function __construct()
    {
        $this->arr = [1,3,5,7,8,9];
        echo "原始数据".json_encode($this->arr)."\n";
    }
    /*
     * 二分查找
     * 对数组二分查找的前提是，数组是已排好序的
     */
    public function BS($data)
    {
        $bs = new BS($this->arr);
        $res = $bs->find($data);
        echo "查找{$data}，结果为：{$res}\n";
    }

    /*
     * 二叉树查找
     */
    public function st($val)
    {
        $data = array_shift($this->arr);
        $tree = new SearchTree($data);
        foreach ($this->arr as $value){
            SearchTree::insert($tree,new SearchTree($value));
        }
        $tree = SearchTree::find($tree,$val);
        $this->res = $tree->minOrder($tree);
        print_r($this->res);
    }
}