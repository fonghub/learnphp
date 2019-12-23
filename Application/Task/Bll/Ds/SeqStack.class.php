<?php
namespace Task\Bll\Ds;

class SeqStack
{
    /**
     * 初始化栈
     */
    public function initStack(&$s,$length)
    {
        $s = new Seq($length);
    }

    /**
     * 销毁栈
     */
    public function DestroyStack(&$s)
    {
        $s = null;
    }

    /**
     * 入栈
     */
    public function push(&$s,$e)
    {
        //首先判断是否栈满
        if ($this->stackFull($s)) {
            return false;
        }
        $s->top++;
        $s->arr[$s->top] = $e;
        return true;
    }

    /**
     * 出栈
     */
    public function pop(&$s,&$e)
    {
        //首先判断是否栈空
        if ($this->stackEnpty($s)) {
            return false;
        }
        $e = $s->arr[$s->top];
        $s->top--;
        return true;
    }

    /**
     * 获取栈顶元素
     */
    public function getTop(&$s,&$e)
    {
        //首先判断是否栈空
        if ($this->stackEnpty($s)) {
            return false;
        }
        $e = $s->arr[$s->top];
        return true;
    }

    /**
     * 栈是否空
     */
    public function stackEnpty($s)
    {
        return ($s->top == -1);
    }

    /**
     * 栈是否满
     */
    public function stackFull($s)
    {
        return ($s->top == $s->length - 1);
    }

    /**
     * 获取栈的长度
     */
    public function stackLength($s)
    {
        return $s->length;
    }
}

/**
 * 顺序栈
 */
class Seq
{
    public $arr = array();
    public $length;
    public $top = -1;
    public function __construct($length)
    {
        $this->length = $length;
    }
}
?>