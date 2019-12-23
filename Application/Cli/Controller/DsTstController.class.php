<?php
namespace Cli\Controller;

use Think\Controller;

class DsTstcontroller extends Controller
{
    public function index()
    {
        echo "index\n";
    }

    /**
     * 顺序表
     */
    public function seqList()
    {
        $list = null;
        $arr = [1,8,8,1,4,0,0,0,0,6,1];
        $seqList = new \Task\Bll\Ds\SeqList();
        $seqList->initList($list);
        foreach($arr as $k => $v){
            $seqList->listInsert($list, $k+1, $v);
        }
        // $res = $seqList->getElem($list,6,$num);
        // if($res)
        //     echo $num;
        // else
        //     echo 'error';
        // echo "\n";
        $result = $seqList->dispList($list);
        print_r($result);
        $seqList->destroyList($list);
        $length = $seqList->listLength($list);
        echo $length;
        echo "\n";
        $result = $seqList->dispList($list);
        print_r($result);
    }

    /**
     * 链表
     */
    public function linkList()
    {
        $list = null;
        $arr = [1,8,8,1,4,0,0,0,0,6,1];
        $linkList = new \Task\Bll\Ds\LinkList();
        // $linkList->createListL($list,$arr);
        $linkList->createListR($list,$arr);
        print_r($list);
    }

    /**
     * 删除顺序表中所有值为$e的数据元素
     */
    public function copyLine()
    {
        $list = null;
        $arr = [1,8,8,1,4,0,0,0,0,6,1];
        $seqList = new \Task\Bll\Ds\SeqList();
        $seqList->initList($list);
        foreach($arr as $k => $v){
            $seqList->listInsert($list, $k+1, $v);
        }
        $result = $seqList->dispList($list);
        print_r($result);
        $seqList->deduplication($list,1);
        $result = $seqList->dispList($list);
        print_r($result);
    }

    public function SeqStack()
    {
        $s = null;
        $arr = [1,8,8,1,4,0,0,0,0,6,1];
        $length = count($arr);
        $seq = new \Task\Bll\Ds\SeqStack();
        $seq->initStack($s,$length);
        echo "push stack: ";
        for($i=0;$i<$length;$i++){
            $seq->push($s,$arr[$i]);
            echo $arr[$i]."\t";
        }
        echo "\n";
        echo "stackLength=".$seq->stackLength($s)."\n";
        echo "pop stack: ";
        while($seq->pop($s,$e)){
            echo $e."\t";
        }
        echo "\n";
    }


    public function LinkStack()
    {
        $s = null;
        $arr = [1,8,8,1,4,0,0,0,0,6,1];
        $length = count($arr);
        $lnk = new \Task\Bll\Ds\LinkStack();
        echo "push stack: ";
        for($i=0;$i<$length;$i++){
            $lnk->push($s,$arr[$i]);
            echo $arr[$i]."\t";
        }
        echo "\n";
        echo "dispStack:";
        $lnk->dispStack($s);
        echo "\n";
        
        $lnk->getTop($s,$e);
        echo "getTop:".$e;
        echo "\n";

        while ($lnk->pop($s,$e)) {
            echo $e."\t";
        }
        echo "\n";

        echo "dispStack:";
        $lnk->dispStack($s);
        echo "\n";
    }
}

?>