<?php
namespace Task\Bll\Ds;

/**
 * 循环队列
 */
class CircularQueue
{
    public function initQueue(&$q,$length)
    {
        $q = new Cir($length);
    }

    public function destroyQueue(&$q)
    {
        $q = null;
    }

    public function QueueEnpty($q)
    {
        return ($q->front == $q->rear);
    }

    public function QueueFull($q)
    {
        return (($q->rear+1)%$q->length == $q->front);
    }

    public function enQueue(&$q,$e)
    {
        if ($this->QueueFull($q))
            return false;

        $q->rear = ($q->rear+1)%$q->length;
        $q->arr[$q->rear] = $e;
        return true;
    }

    public function deQueue(&$q,&$e)
    {
        if($this->QueueEnpty($q))
            return false;

        $q->front = ($q->front+1)%$q->length;
        $e = $q->arr[$q->front];
        unset($q->arr[$q->front]);
        return true;
    }
}

/**
 * 循环队列
 */
class Cir
{
    public $arr = array();
    public $length = 0;
    //队首和队尾指针均指向索引为0的位置
    public $front = 0;
    public $rear = 0;

    public function __construct($length)
    {
        $this->length = $length;    
    }
}
?>