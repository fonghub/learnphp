<?php
namespace Task\Bll\Ds;
class LinkQueue
{
    public function initQueue(&$q)
    {
        $q = new Queue();
    }

    public function destroyQueue(&$q)
    {
        $pre = $q->front;
        if($pre != null){
            $p = $pre->next;
            while($p != null){
                unset($pre);
                $pre = $p;
                $p = $p->next;
            }
        }
        unset($q);
    }

    /**
     * 是否空队
     */
    public function queueEmpty($q)
    {
        return ($q->rear == null);
    }

    /**
     * 入队
     */
    public function enQueue(&$q,$e)
    {
        $node = new Node();
        $node->data = $e;
        if($this->queueEmpty($q)){
            //第一个元素入队，把队首、队尾指针指向第一个元素
            $q->front = $q->rear = $node;
        }else{
            $q->rear->next = $node;
            $q->rear = $node;
        }
    }

    /**
     * 出队
     */
    public function deQueue(&$q,&$e)
    {
        if($this->queueEmpty($q))
            return false;

        $outNode = $q->front;
        if($q->front == $q->rear){
            //队列只剩下一个元素时，把队首、队尾指针指向null
            $q->front = $q->rear = null;
        }else{
            $q->front = $q->front->next;
        }
        $e = $outNode->data;
        unset($outNode);
        return true;
    }
}

class Node
{
    public $data = null;
    public $next = null;
}

class Queue
{
    public $front = null;
    public $rear = null;
}