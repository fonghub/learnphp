<?php
namespace Task\Bll\Ds\Queue;

class SeqQueue
{
    public function initQueue(&$q,$length)
    {
        $q = new Seq($length);
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
        return ($q->rear == $q->length - 1);
    }

    public function enQueue(&$q,$e)
    {
        if ($this->QueueFull($q)) {
            return false;
        }

        $q->rear++;
        $q->arr[$q->rear] = $e;
        return true;
    }

    public function deQueue(&$q,&$e)
    {
        if($this->QueueEnpty($q))
            return false;

        $q->front++;
        $e = $q->arr[$q->front];
        unset($q->arr[$q->front]);
        return true;
    }
}

/**
 * 顺序队列
 */
class Seq
{
    public $arr = array();
    public $length = 0;
    public $front = -1;
    public $rear = -1;

    public function __construct($length)
    {
        $this->length = $length;    
    }
}
?>