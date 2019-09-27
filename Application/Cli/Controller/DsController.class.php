<?php
namespace Cli\Controller;

use Task\Bll\Ds\MinHeap;
use Task\Bll\Ds\Tree;
use Think\Controller;
use Task\Bll\Ds\Bubble;
use Task\Bll\Ds\Insert;
use Task\Bll\Ds\Select;
use Task\Bll\Ds\Quick;


class DsController extends Controller
{
	public $input = [];
	public $out = [];

	public function __construct()
	{
		$this->input = [2,5,3,8,7,1,9,0,4,6];
		echo "排序前：\n";
		echo json_encode($this->input)."\n";
	}
	/*
	*冒泡排序
	*/
	public function bubble()
	{
		$bubble = new Bubble();
		$this->out = $bubble->index($this->input);
	}
	/*
	*插入排序
	*/
	public function insert()
	{
		$insert = new Insert();
		$this->out = $insert->index($this->input);
	}

	/*
	*值交换
	*/
	public function select()
	{
		$select = new Select();
		$this->out = $select->index($this->input);
	}

	/*
	*索引交换
	*/
	public function select2()
	{
		$select = new Select();
		$this->out = $select->index2($this->input);
	}

	/*
	*快速排序
	*/
	public function quick()
	{
		$quick = new Quick();
		$this->out = $quick->index($this->input);
	}

	public function tree()
	{
	    $data = array_shift($this->input);
        $tree = new Tree($data);
        while (count($this->input)){
            $data = array_shift($this->input);
            $tree->insert($tree,new Tree($data));
        }
        $this->out = $tree->minOrder($tree);
	}

	public function heap()
	{
        $minHeap = new MinHeap($this->input);
        $this->out = $minHeap->sort();
	}

	public function __destruct()
	{
		echo "排序后：\n";
		echo json_encode($this->out)."\n";
	}
}