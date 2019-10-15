<?php
namespace Task\Bll\Algorithm\Sorting;


/*
 * 插入排序
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/3.%E6%8E%92%E5%BA%8F%E7%AF%87%E4%B9%8B%E7%9B%B4%E6%8E%A5%E6%8F%92%E5%85%A5%E6%8E%92%E5%BA%8F.md
 */
class Insert
{

    public static function index($arr)
    {
        $length = count($arr);

        //从左到右，从小到大
        //从第二个数开始开始插入顺序队列
        //每一次得到的部分队列都是排好序的
        //从部分顺序队列的右边开始比较
        for ($outer = 1; $outer < $length; $outer++){
            if ($arr[$outer] < $arr[$outer - 1]){
                $temp = $arr[$outer];
                $inner = $outer - 1;
                while ($inner >= 0 && $arr[$inner] > $temp){
                    $arr[$inner + 1] = $arr[$inner];
                    $inner--;
                }

                $arr[++$inner] = $temp;
            }
            echo "第".($outer)."轮排序：".json_encode($arr)."\n";
        }
        return $arr;
    }
}