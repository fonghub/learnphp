<?php


namespace Cli\Controller;


use Task\Bll\DataStructure\Linear;
use Task\Bll\DataStructure\Linked;
use Task\Bll\DataStructure\Queue;
use Task\Bll\DataStructure\SearchTree;
use Task\Bll\DataStructure\Stack;
use Task\Bll\DataStructure\Tree;
use Task\Bll\DataStructure\viewTree;
use Think\Controller;

class DsController extends Controller
{

    public function index()
    {
        echo 'index';
    }

    public function linear()
    {
        $linear = new Linear();
        $linear->add_item(0,1);
        $linear->add_item(1,2);
        $linear->add_item(1,3);
        $linear->add_item(1,4);
        $linear->add_item(1,5);
        $linear->add_item(1,6);
        $linear->add_item(1,7);
        $linear->get_items();

        $linear->del_item(1);
        $linear->get_items();

        echo $linear->get_item(2)."\n";

        echo $linear->get_index(6)."\n";

        $linear->update_item(1,7);
        $linear->get_items();

        $linear->truncate();
        $linear->add_item(0,1);
        $linear->get_items();

    }

    public function linked()
    {
        $link = new Linked();

        $link->add_item(0,'zf');
        $link->add_item(1,20);
        $link->add_item(2,'cl');
        $link->add_item(3,'st');
        $link->add_item(4,'gz');
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $length = $link->get_length();
        echo "length={$length}\n";

        $link->del_item(1);
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $link->interrupt(2);
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $link->truncate();
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";
    }

    public function stack()
    {
        $stack = new Stack();
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $stack->push(4);

        $arr = $stack->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $value = $stack->pop();
        echo "pop value={$value}\n";
        $arr = $stack->get_items();
        echo "All items: ".json_encode($arr)."\n";
    }


    public function queue()
    {
        $queue = new Queue();
        $queue->push(1);
        $queue->push(2);
        $queue->push(3);
        $queue->push(4);
        $queue->push(5);

        $arr = $queue->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $queue->shift();
        $arr = $queue->get_items();
        echo "All items: ".json_encode($arr)."\n";
    }

    public function tree()
    {
        $tree = new Tree(1);
        $left = $tree->setLeft(new Tree(2));
        $right = $tree->setRight(new Tree(3));

        $left->setLeft(new Tree(4));
        $left->setRight(new Tree(5));

        $right->setRight(new Tree(6));
//        print_r($tree);
        $tree->preOrder($tree);
        echo "\n";
        $tree->midOrder($tree);
        echo "\n";
        $tree->sufOrder($tree);
        echo "\n";

    }

    public function searchTree()
    {
        $tree = new SearchTree(10);
        SearchTree::insert($tree,new SearchTree(2));
        SearchTree::insert($tree,new SearchTree(30));
        SearchTree::insert($tree,new SearchTree(26));
        SearchTree::insert($tree,new SearchTree(12));
        SearchTree::insert($tree,new SearchTree(8));
        SearchTree::insert($tree,new SearchTree(1));
        $tree->preOrder($tree);
        echo "\n";
        $tree->minOrder($tree);
        echo "\n";
        $tree->subOrder($tree);
        echo "\n";

        $node = SearchTree::find($tree,2);
        print_r($node);

        $min = SearchTree::findMin($tree);
        $max = SearchTree::findMax($tree);
        echo $min.PHP_EOL;
        echo $max.PHP_EOL;
    }

    public function heap()
    {

    }
}