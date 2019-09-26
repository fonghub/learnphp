<?php


namespace Task\Bll\Ds;


class MinHeap
{
    public $arr = [];
    public $length = 0;

    public function __construct($arr)
    {
        $this->arr = $arr;
        $this->length = count($this->arr);
        array_unshift($this->arr,null);
        $this->shiftUp();
    }

    public function sort()
    {
        $data = [];
        while ($this->length){
            $data[] = $this->get();
        }
        return $data;
    }

    public function get()
    {
        $temp = $this->arr[1];
        $this->arr[1] = $this->arr[$this->length];
        $this->shiftUp();
        unset($this->arr[$this->length]);
        $this->length--;
        return $temp;
    }

    public function shiftUp()
    {
        $size = $this->length;
        if ($size % 2)
            $size--;
        for ($i = $size; $i > 1; $i = $i - 2) {
            $parent = $i >> 1;
            if ($i < $this->length && $this->arr[$i] > $this->arr[$i + 1])
                $i++;

            if ($this->arr[$i] < $this->arr[$parent]){
                $temp = $this->arr[$i];
                $this->arr[$i] = $this->arr[$parent];
                $this->arr[$parent] = $temp;
            }

            $this->shiftDown($i);
            if ($i % 2)
                $i--;
        }
    }

    public function shiftDown($header)
    {
        $child = $header * 2;
        if ($child <= $this->length){
            if ($child < $this->length && $this->arr[$child] > $this->arr[$child + 1])
                $child++;

            if ($this->arr[$child] < $this->arr[$header]){
                $temp = $this->arr[$child];
                $this->arr[$child] = $this->arr[$header];
                $this->arr[$header] = $temp;
            }
            $this->shiftDown($child);
        }
    }

    public function result()
    {
        return $this->arr;
    }
}