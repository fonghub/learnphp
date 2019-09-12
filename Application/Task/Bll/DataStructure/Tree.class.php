<?php


namespace Task\Bll\DataStructure;


class Tree
{
    public $left = null;
    public $right = null;
    public $parent = null;
    public $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setLeft(Tree $tree)
    {
        $tree->parent = $this;
        $this->left = $tree;
        return $tree;
    }

    public function setRight(Tree $tree)
    {
        $tree->parent = $this;
        $this->right = $tree;
        return $tree;

    }
}
