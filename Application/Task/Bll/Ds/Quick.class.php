<?php
namespace Task\Bll\Ds;

class Quick
{
	public function index($arr)
	{
		$length = count($arr);
		$left = [];
		$right = [];
		if ($length <= 1) {
			return $arr;
		}

		$mid_index = $length >> 1;
		for($i=0;$i<$length;$i++){
			if ($mid_index == $i) {
				continute;
			}
			if ($arr[$mid_index] > $arr[$i]) {
				$left[] = $arr[$i];
			}elseif ($arr[$mid_index] < $arr[$i]) {
				$right[] = $arr[$i];
			}
		}

		return array_merge($this->index($left),array($arr[$mid_index]),$this->index($right));
	}	
}