<?php


namespace Task\Bll\DataStructure;

/*
 * 线性表-顺序存储
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/4.%E6%95%B0%E6%8D%AE%E7%BB%93%E6%9E%84%E4%B9%8B%E7%BA%BF%E6%80%A7%E8%A1%A8%EF%BC%88%E9%A1%BA%E5%BA%8F%E5%AD%98%E5%82%A8%E8%A1%A8%EF%BC%89.md
 * 操作线性表功能：
 * * 添加元素
 * * 删除元素
 * * 查看元素数量
 * * 获取某个位置上的数据
 * * 根据数据获取数据位置
 * * 更改某个位置上的数据
 * * 清空线性表
 */
class Linear
{

    public $items = array();

    //添加元素
    //从索引下标位置的元素开始，向后退一位，插入新元素
    public function add_item($index,$item)
    {
        $length = $this->get_length_v($index);
        for ($i = $length; $i > $index; $i--){
            $this->items[$i] = $this->items[$i - 1];
        }
        $this->items[$index] = $item;
    }

    //删除元素
    //从索引下标位置+1的元素开始，向前进一位，删除最后一位元素
    public function del_item($index)
    {
        $length = $this->get_length_v($index);
        for ($i = $index; $i < $length; $i++){
            $this->items[$i] = $this->items[$i + 1];
        }
        unset($this->items[$length - 1]);
    }

    //查看元素数量
    public function get_length()
    {
        return count($this->items);
    }

    //查看元素数量
    //并且验证索引下标合法性
    public function get_length_v($index)
    {
        $length = $this->get_length();
        if ($index < 0 || $index > $length){
            return false;
        }
        return $length;
    }

    //获取某个位置上的数据
    public function get_item($index)
    {
        $this->get_length_v($index);
        return $this->items[$index];
    }

    //根据数据获取数据位置
    public function get_index($item)
    {
        $length = $this->get_length();
        for ($i = 0; $i < $length; $i++){
            if ($item == $this->items[$i]){
                return $i;
            }
        }
    }

    //更改某个位置上的数据
    public function update_item($index,$item)
    {
        $this->get_length_v($index);
        $this->items[$index] = $item;
    }

    //清空线性表
    public function truncate()
    {
        $this->items = array();
    }

    //获取线性表上的所有数据
    public function get_items()
    {
        $length = $this->get_length();
        for ($i = 0; $i < $length; $i++){
            echo $this->items[$i]." ";
        }
        echo "\n";
    }
}