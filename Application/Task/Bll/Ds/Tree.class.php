<?php


namespace Task\Bll\Ds;


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

    public function insert(Tree $tree, Tree $node)
    {
        if ($tree->data > $node->data) {

            if ($tree->left instanceof Tree) {
                $this->insert($tree->left,$node);
            } else {
                $this->setLeft($tree,$node);
            }
        } elseif ($tree->data < $node->data) {

            if ($tree->right instanceof Tree) {
                $this->insert($tree->right,$node);
            } else {
                $this->setRight($tree,$node);
            }
        }
    }


    public function setLeft(Tree $tree, Tree $node)
    {
        $node->parent = $tree;
        $tree->left = $node;
    }

    public function setRight(Tree $tree, Tree $node)
    {
        $node->parent = $tree;
        $tree->right = $node;
    }

    public function minOrder($tree)
    {
        if ($tree instanceof Tree){
            $this->minOrder($tree->left);
            echo  $tree->data."\t";
//            $data = $tree->data."\n";
            $this->minOrder($tree->right);

//            return array_merge($this->minOrder($tree->left),array($data),$this->minOrder($tree->right));
        }

    }

}