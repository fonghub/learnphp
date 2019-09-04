<?php

namespace Task\Bll\DataStructure;

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