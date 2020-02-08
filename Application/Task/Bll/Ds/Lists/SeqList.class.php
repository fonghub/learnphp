<?php
namespace Task\Bll\Ds\Lists;

class SeqList
{

    /**
     * 初始化顺序表L
     */
    public function initList(&$L)
    {
        $L = new Seq();
    }
    
    /**
     * 销毁顺序表L
     */
    public function destroyList(&$L)
    {
        $L = null;
    }
    
    /**
     * 若L为空表，则返回真，否则返回假
     */
    public function listEmpty($L)
    {
        if(!$L->length)
            return true;
        else
            return false;
    }
    
    /**
     * 顺序表L不为空时，显示L的长度
     * 为空时，显示0
     */
    public function listLength($L)
    {
        if($this->ListEmpty($L))
            return 0;
        return $L->length;
    }
    
    /**
     * 当顺序表L不为空时，顺序显示L中各节点的值域
     * 为空时，显示空数组
     */
    public function dispList($L)
    {
        if($this->ListEmpty($L))
            return [];
        $arr = [];
        for($i = 0; $i < $L->length; $i++){
            $arr[] = $L->arr[$i];
        }
        return $arr;
    }
    
    /**
     * 求顺序表L中指定位置的某个数据元素
     * 用e返回L中第 i 个元素的值
     */
    public function getElem($L,$i,&$e)
    {
        if($i < 1 || $i > $L->length)
            return false;
        $e = $L->arr[$i-1];
        return true;
    }
    
    /**
     * 查找元素索引/序号
     * 返回顺序表L中第1个与e相等的序号，找不到返回0
     */
    public function locateElem($L,$e)
    {
        //根据length来确定数据的个数
        for($i = 0; $i < $L->length; $i++){
            if($L->arr[$i] == $e)
                return $i+1;
        }
        return 0;
    }
    
    /**
     * 插入元素
     * 在顺序表L中的第i个位置插入元素e
     */
    public function listInsert(&$L, $i, $e)
    {
        //i的范围[1,length+1]
        if($i < 1 || $i > $L->length+1)
            return false;
        $i--;//逻辑序号转物理序号
        for($j = $L->length; $j > $i; $j--){
            $L->arr[$j-1] = $L->arr[$j];
        }
        $L->arr[$i] = $e;
        $L->length++;
        return true;
    }
    
    /**
     * 删除元素
     * 在顺序表L中删除第i个元素，由e返回删除的值；
     */
    public function listDelete(&$L, $i, &$e)
    {
        //i的范围[1,length]
        if($i < 1 || $i > $L->length)
            return false;
        $i--;//逻辑序号转物理序号
        $e = $L->arr[$i];
        for($j = $i; $j < $L->length - 1; $j++){
            $L->arr[$i] = $L->arr[$i+1];
        }
        $L->length--;
        return true;
    }

    /**
     * 删除顺序表中所有值为$e的数据元素
     */
    public function deduplication(&$L,$e)
    {
        $i = 0;
        for($j = 0; $j < $L->length; $j++){
            if($L->arr[$j] != $e){
                $L->arr[$i++] = $L->arr[$j];
            }
        }
        $L->length = $i;
    }

}

/**
 * 顺序表
 */
class Seq
{
    public $arr = array();
    public $length = 0;
}