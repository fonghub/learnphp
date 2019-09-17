<?php


namespace Home\Controller;


use Task\Bll\File\OpFile;

class FileController
{

    public $filepath = null;
    public $of = null;

    public function __construct()
    {
        $this->filepath = dirname(realpath(APP_PATH))."/Public/Common/Cache/";
        $this->of = new OpFile($this->filepath,'tst','a+');
    }

    public function tst_w()
    {
        $str = "Hello wrold.\n";
        for ($i=0;$i<1000000;$i++){
            $res = $this->of->write($str);
            echo $res."<br>";
        }
    }
    public function w()
    {
        $str = "Hello wrold.\n";
        $res = $this->of->write($str);
        if ($res)
            jsonsuccess('ok',"写入成功-{$res}");
    }

    public function r($length = 12)
    {
        $res = $this->of->read($length);
        if ($res)
            jsonsuccess('ok',$res);
    }


    /**
     * $length == 0 读一行
     * $length ！= 0 读 $length 个字符
     */
    public function gs($length = null)
    {
        $res = $this->of->gets($length);
        if ($res)
            jsonsuccess('ok',$res);
    }

    public function ps()
    {
        $str = "Hello wrold.\n";
        $res = $this->of->puts($str);
        if ($res)
            jsonsuccess('ok',"写入成功-{$res}");
    }

    /*
     * 读取大文件，方法1
     */
    public function all()
    {
        while (!($this->of->eof())){
            $str = $this->of->gets();
            echo $str."<br>";
        }
    }

    private function yi()
    {
        while (!($this->of->eof())){
            yield $this->of->gets();
        }
    }

    /*
     * 读取大文件，方法2
     */
    public function all2()
    {
        foreach ($this->yi() as $k => $v){
            echo $k." ".$v."<br>";
        }
    }

    public function __destruct()
    {
        $this->of->close();
    }
}