<?php
namespace Task\Bll\Algorithm\Sorting;

/*
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/2.%E6%8E%92%E5%BA%8F%E7%AF%87%E4%B9%8B%E9%80%89%E6%8B%A9%E6%8E%92%E5%BA%8F.md
 */
class Select
{
    public static function index($arr)
    {
        $lenght = count($arr);
        $change = 0;
        for ($outer = 0; $outer < $lenght - 1; $outer++) {//$lenght - 1，不减1，内存循环会出现越界错误
            $min_index = $outer;
            $flag = true;
            for ($inner = $outer + 1; $inner < $lenght; $inner++) {
                if ($arr[$min_index] > $arr[$inner]) {
                    $min_index = $inner;
                    $change++;
                    $flag = false;
                }
            }
            if ($flag) break;
            if ($min_index != $outer){
                $temp = $arr[$outer];
                $arr[$outer] = $arr[$min_index];
                $arr[$min_index] = $temp;
            }
            echo "第".($outer + 1)."轮排序：".json_encode($arr)."\n";
        }
        return array('change'=>$change,'result'=>$arr);
    }

    /*
    * “交换值”
    */
    public static function index2($arr)
    {
        $lenght = count($arr);
        $change = 0;
        for ($outer = 0; $outer < $lenght; $outer++) {
            for ($inner = $outer + 1; $inner < $lenght; $inner++) {
                if ($arr[$outer] > $arr[$inner]) {
                    $temp = $arr[$outer];
                    $arr[$outer] = $arr[$inner];
                    $arr[$inner] = $temp;
                    $change++;
                }
            }
            echo "第".($outer + 1)."轮排序：".json_encode($arr)."\n";
        }
        return array('change'=>$change,'result'=>$arr);
    }
}