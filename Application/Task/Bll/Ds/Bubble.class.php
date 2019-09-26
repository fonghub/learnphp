<?php
namespace Task\Bll\Ds;

/*
*冒泡排序
*/
class Bubble
{
	public function index($arr)
	{
		$length = count($arr);
		if ($length <= 1) {
			return $arr;
		}

		for ($out = 0; $out < $length - 1; $out++) { 
			$flag = true;
			for ($inner = $length - 1; $inner > $out; $inner--) { 
				if ($arr[$inner - 1] > $arr[$inner]) {
					$temp = $arr[$inner - 1];
					$arr[$inner - 1] = $arr[$inner];
					$arr[$inner] = $temp;
					$flag = false;
				}
			}

			if ($flag) {
				break;
			}
		}
		return $arr;
	}


}