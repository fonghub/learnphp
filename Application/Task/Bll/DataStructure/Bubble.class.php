<?php

namespace Task\Bll\DataStructure;

/*
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/1.%E6%8E%92%E5%BA%8F%E7%AF%87%E4%B9%8B%E5%86%92%E6%B3%A1%E6%8E%92%E5%BA%8F.md
 */
class Bubble
{

    /*
     * “交换排序”
     */
    public static function index($arr)
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

    /*
     * 冒泡排序
     */
    public static function index1($arr)
    {
        $lenght = count($arr);
        $change = 0;
        for ($outer = 0; $outer < $lenght - 1; $outer++) {
            $flag = true;
            for ($inner = $lenght - 1; $inner > $outer; $inner--){
                if ($arr[$inner - 1] > $arr[$inner]){
                    $temp = $arr[$inner - 1];
                    $arr[$inner - 1] = $arr[$inner];
                    $arr[$inner] = $temp;
                    $change++;
                    $flag = false;
                }
            }
            echo "第".($outer + 1)."轮排序：".json_encode($arr)."\n";
            if ($flag) break;
        }
        return array('change'=>$change,'result'=>$arr);
    }
}