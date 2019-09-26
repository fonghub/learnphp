<?php
namespace Task\Bll\Ds;

/*
*插入排序
*/
class Insert
{
	public function index($arr)
	{
		$length = count($arr);

		for($out = 1; $out < $length; $out++){
			$temp = $arr[$out];

			for($inner = $out - 1;$inner >= 0 && $arr[$inner] > $temp;$inner--){
				$arr[$inner + 1] = $arr[$inner];
			}
			$arr[++$inner] = $temp;
		}
		return $arr;
	}
}