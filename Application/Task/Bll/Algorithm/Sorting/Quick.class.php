<?php
namespace Task\Bll\Algorithm\Sorting;

/*
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/14.%E6%8E%92%E5%BA%8F%E7%AF%87%E4%B9%8B%E5%BF%AB%E9%80%9F%E6%8E%92%E5%BA%8F%E4%B9%8B%E5%85%A5%E9%97%A8%E7%AF%87.md
 */
class Quick
{
    public static function index($arr)
    {
        $length = count($arr);
        if ($length <= 1) {
            return $arr;
        }

        $mid_index = $length >> 1;
        $left = [];
        $right = [];

        for ($i = 0; $i < $length; $i++) {
            if ($i == $mid_index)
                continue;

            if ($arr[$i] > $arr[$mid_index])
                $right[] = $arr[$i];
            elseif ($arr[$i] < $arr[$mid_index])
                $left[] = $arr[$i];
        }
        return array_merge(self::index($left), array($arr[$mid_index]), self::index($right));
    }

}