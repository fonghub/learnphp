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

    // 前序遍历
    public function preOrder( $tree ){
        if( $tree instanceof Tree ){
            // 先遍历根节点
            echo $tree->data.'  ';
            // 然后遍历左子树
            $this->preOrder( $tree->left );
            // 最后遍历右子树
            $this->preOrder( $tree->right );
        }
    }
    // 中序遍历
    public function midOrder( $tree ){
        if( $tree instanceof Tree ){
            // 先遍历左子树
            $this->midOrder( $tree->left );
            // 再遍历根节点
            echo $tree->data.'  ';
            // 后遍历右子树
            $this->midOrder( $tree->right );
        }
    }
    // 后续遍历
    public function sufOrder( $tree ){
        if( $tree instanceof Tree ){
            // 先遍历左子树
            $this->sufOrder( $tree->left );
            // 再遍历右子树
            $this->sufOrder( $tree->right );
            // 最后遍历根节点
            echo $tree->data.'  ';
        }
    }
}
