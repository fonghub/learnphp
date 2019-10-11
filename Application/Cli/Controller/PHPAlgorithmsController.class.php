<?php
declare(strict_types=1);
namespace Cli\Controller;

use Doganoo\PHPAlgorithms\Algorithm\Sorting\BubbleSort;
use Doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree;

class PHPAlgorithmsController
{
    public function index(){
        $binaryTree = new BinaryTree();
        $binaryTree->insertValue(50);
        $binaryTree->insertValue(25);
        $binaryTree->insertValue(75);
        $binaryTree->insertValue(10);
        $binaryTree->insertValue(100);

        echo json_encode($binaryTree);
    }

    public function bubbleSort()
    {
        $arr = array(1,3,2,4,8,7,5,9);
        print_r($arr);
        $bs = new BubbleSort();
        $res = $bs->sort($arr);
        print_r($res);
    }
}
