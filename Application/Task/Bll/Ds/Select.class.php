<?php
namespace Task\Bll\Ds;

/*
*选择排序
*/
class Select
{
	/*
	*交换值
	*/
	public function index($arr)
	{
		$length = count($arr);
		for ($out=0; $out < $length - 1; $out++) { 
			for ($inner=$out + 1; $inner < $length; $inner++) { 
				if ($arr[$out] > $arr[$inner]) {
					$temp = $arr[$out];
					$arr[$out] = $arr[$inner];
					$arr[$inner] = $temp;
				}
			}
		}
		return $arr;
	}

	public function index2($arr)
	{
		$length = count($arr);
		for ($out=0; $out < $length - 1; $out++) { 
			$min_index = $out;
			for ($inner=$out + 1; $inner < $length; $inner++) { 
				if ($arr[$min_index] > $arr[$inner]) {
					$min_index = $inner;
				}
			}
			if ($min_index != $out) {
				$temp = $arr[$out];
				$arr[$out] = $arr[$min_index];
				$arr[$min_index] = $temp;
			}
		}
		return $arr;
	}
}