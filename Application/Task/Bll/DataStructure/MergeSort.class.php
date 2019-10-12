<?php
namespace Task\Bll\DataStructure;
 class MergeSort
 {
     public static function sort(array $arr): array
     {
        $lenght = count($arr);
        if ($lenght == 0) return [];
        if ($lenght == 1) return $arr;
        $minIndex = $lenght >> 1;
        $left = array_slice($arr,0,$minIndex);
        $right = array_slice($arr,$minIndex);
        $left = self::sort($left);
        $right = self::sort($right);
        return self::mergeS($left,$right);
     }

     public static function mergeS(array $left,array $right): array
     {
         $res = [];
         while (count($left) > 0 && count($right) > 0) {
            if ($left[0] > $right[0]) {
                $res[] = $right[0];
                $right = array_slice($right,1);
            }else{
                $res[] = $left[0];
                $left = array_slice($left,1);
            }
         }

         while (count($left) > 0) {
            $res[] = $left[0];
            $left = array_slice($left,1);
         }

        while (count($right) > 0) {
            $res[] = $right[0];
            $right = array_slice($right,1);
         }
         return $res;
     }
 }
 