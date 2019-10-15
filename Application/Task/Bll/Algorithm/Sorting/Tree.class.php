<?php
namespace Task\Bll\Algorithm\Sorting;


class Tree
{
    public $data = null;
    public $parent = null;
    public $left = null;
    public $right = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function insert(Tree $tree, Tree $node)
    {
        if ($tree->data > $node->data) {

            if ($tree->left instanceof Tree) {
                self::insert($tree->left,$node);
            } else {
                self::setLeft($tree,$node);
            }
        } elseif ($tree->data < $node->data) {

            if ($tree->right instanceof Tree) {
                self::insert($tree->right,$node);
            } else {
                self::setRight($tree,$node);
            }
        }
    }


    public static function setLeft(Tree $tree, Tree $node)
    {
        $node->parent = $tree;
        $tree->left = $node;
    }

    public static function setRight(Tree $tree, Tree $node)
    {
        $node->parent = $tree;
        $tree->right = $node;
    }

    public function minOrder($tree)
    {
        if ($tree instanceof Tree){
            $left = $this->minOrder($tree->left);
            $mid =  [$tree->data];
            $right = $this->minOrder($tree->right);
            return array_merge($left,$mid,$right);
        }else{
            return [];
        }

    }

}