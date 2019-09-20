<?php


namespace Cli\Controller;


class TesController
{

    public function index()
    {
        $arr = [1,2,3,4,5];
        print_r($arr);
        array_shift($arr);
        print_r($arr);
        array_unshift($arr,0);
        print_r($arr);
    }

    public function heap()
    {
        $max = new \SplMaxHeap();
        $max->insert(7);
        $max->insert(3);
        $max->insert(6);
        $max->insert(8);
        $max->insert(1);
        $max->insert(9);
        $max->insert(2);
        $max->insert(5);
        $max->insert(4);
        while ($max->valid())
            echo $max->extract()."\t";
        echo "\n";
    }
}