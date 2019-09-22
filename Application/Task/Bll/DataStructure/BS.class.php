<?php


namespace Task\Bll\DataStructure;

/*
 * 二分查找
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/13.%E5%9F%BA%E7%A1%80%E6%9F%A5%E6%89%BE%E4%B9%8B%E4%BA%8C%E5%88%86%E6%9F%A5%E6%89%BE.md
 */
class BS
{

    private $arr = array();
    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function find($data)
    {
        $start_index = 0;
        $end_index = count($this->arr) - 1;

        while ($start_index <= $end_index){
            $mid_index = floor(($start_index + $end_index) / 2);
            if ($this->arr[$mid_index] > $data){
                $end_index = $mid_index - 1;
            }elseif ($this->arr[$mid_index] < $data){
                $start_index = $mid_index + 1;
            }elseif ($this->arr[$mid_index] == $data){
                return $mid_index;
            }
        }

        return "not found";
    }
}