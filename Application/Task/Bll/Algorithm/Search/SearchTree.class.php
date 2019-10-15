<?php
namespace Task\Bll\Algorithm\Search;

/*
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/10.%E6%95%B0%E6%8D%AE%E7%BB%93%E6%9E%84%E4%B9%8B%E4%BA%8C%E5%8F%89%E6%90%9C%E7%B4%A2%E6%A0%91%EF%BC%88%E4%BA%8C%EF%BC%89.md
 */
class SearchTree
{

    public $parent = null;
    public $left = null;
    public $right = null;
    public $data = null;

    public function __construct($item)
    {
        $this->data = $item;
    }

    public function setLeft(SearchTree $tree)
    {
        $tree->parent = $this;
        $this->left = $tree;
        return $tree;
    }

    public function setRight(SearchTree $tree)
    {
        $tree->parent = $this;
        $this->right = $tree;
        return $tree;
    }

    public static function preOrder($tree)
    {
        if ($tree instanceof SearchTree){
            $data = [$tree->data];
            $left = self::preOrder($tree->left);
            $right = self::preOrder($tree->right);
            return array_merge($data,$left,$right);
        }else{
            return [];
        }
    }


    public static function minOrder($tree)
    {
        if ($tree instanceof SearchTree){
            $left = self::minOrder($tree->left);
            $data = [$tree->data];
            $right = self::minOrder($tree->right);
            return array_merge($left,$data,$right);
        }else{
            return [];
        }
    }


    public static function subOrder($tree)
    {
        if ($tree instanceof SearchTree){
            $left = self::subOrder($tree->left);
            $right = self::subOrder($tree->right);
            $data = [$tree->data];
            return array_merge($left,$right,$data);
        }else{
            return [];
        }
    }

    public static function insert($tree,$node)
    {
        if ($node->data < $tree->data){
            if ($tree->left){
                $tree = $tree->left;
                self::insert($tree,$node);
            }else{
                $tree->setLeft($node);
            }
        }elseif ($node->data > $tree->data){
            if ($tree->right){
                $tree = $tree->right;
                self::insert($tree,$node);
            }else{
                $tree->setRight($node);
            }
        }
    }

    public static function find($tree,$value)
    {
        if (!($tree instanceof SearchTree)){
            return false;
        }
        while ($tree){
            if ($tree->data > $value){
                $tree = $tree->left;
            }elseif ($tree->data < $value){
                $tree = $tree->right;
            }else{
                return $tree;
            }
        }
    }

    public static function findMin($tree)
    {
        if (!($tree instanceof SearchTree)){
            return false;
        }
        while ($tree->left){
            $tree = $tree->left;
        }

        return $tree->data;
    }

    public static function findMax($tree)
    {
        if (!($tree instanceof SearchTree)){
            return false;
        }
        while ($tree->right){
            $tree = $tree->right;
        }

        return $tree->data;
    }
}