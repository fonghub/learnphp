<?php


namespace Task\Bll\DataStructure;


/*
 * https://www.jianshu.com/p/6b526aa481b1
 */
class MaxHeap1
{

    public $size = 0;
    private $element = [];

    public function __construct($arr)
    {
        $this->element = $arr;
        $this->size = count($arr);
        array_unshift($this->element,null);
        $this->shiftUP();
    }

    /*
     * 堆化
     * 子节点向上浮
     */
    public function shiftUP()
    {
        $size = $this->size;
        if ($size % 2)
            $size--;
        for ($child = $size;$child > 0; $child -= 2){
            $parent = $child / 2;
            if ($child < $this->size && $this->element[$child] < $this->element[$child + 1]){
                $child++;
            }
            if ($this->element[$parent] < $this->element[$child]){
                $this->swap($parent,$child);
            }
            $this->shiftDown($child);
            if ($child % 2)
                $child--;
        }
    }

    /*
     * 父节点向下沉
     */
    public function shiftDown($parent)
    {
        $child = $parent * 2;
        if ($child <= $this->size){
            if ($child < $this->size && $this->element[$child] < $this->element[$child + 1]){
                $child++;
            }

            if ($this->element[$parent] < $this->element[$child]){
                $this->swap($parent,$child);
            }
            $this->shiftDown($child);
        }
    }

    /*
     * 交换
     */
    public function swap($i1,$i2)
    {
        $temp = $this->element[$i1];
        $this->element[$i1] = $this->element[$i2];
        $this->element[$i2] = $temp;
    }

    /*
     * 插入元素
     */
    public function insert($data)
    {
        $this->element[$this->size + 1] = $data;
        $this->size++;
        $this->shiftUP();
    }

    /*
     * 获取最大值
     */
    public function get()
    {
        $data = $this->element[1];
        $this->element[1] = $this->element[$this->size];
        $this->shiftUP();
        unset($this->element[$this->size]);
        $this->size--;
        return $data;
    }

    public function getElement()
    {
        return $this->element;
    }

    /*
     * 堆排序
     */
    public function sort()
    {
        $data = [];
        while ($this->size){
            $data[] = $this->get();
        }
        return $data;
    }
}