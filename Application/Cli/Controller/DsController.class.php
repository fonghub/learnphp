<?php
namespace Cli\Controller;

use Think\Controller;
use Task\Bll\Ds\Bubble;
use Task\Bll\Ds\Insert;
use Task\Bll\Ds\Select;


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

	public function __destruct()
	{
		echo "排序后：\n";
		echo json_encode($this->out)."\n";
	}
}