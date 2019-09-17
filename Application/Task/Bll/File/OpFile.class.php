<?php

namespace Task\Bll\File;

class OpFile
{

    private $file = null;
    private $filepath = null;
    private $filename = null;
    private $mod = null;

    public function __construct($filepath,$filename, $mod)
    {
        $this->filepath = $filepath;
        $this->filename = $filename;
        $this->mod = $mod;

        $this->open();
    }

    public function open()
    {
        $filename = $this->filename();
        $this->file = fopen($filename, $this->mod);
    }

    public function getDirname()
    {
        return date("Y-m-d");
    }

    public function filename()
    {
        $dirname = $this->getDirname();
        $filepath = $this->filepath.$dirname;
        if (!is_dir($filepath))
            mkdir($filepath,0777,true);
        return $filepath."/".$this->filename;
    }

    public function read($length)
    {
        return fread($this->file,$length);
    }

    public function write($str = null)
    {
        if (empty($str))
            exit("write error");
        return fwrite($this->file, $str, strlen($str));
    }

    public function gets($length = null)
    {
        if (empty($length))
            return fgets($this->file);
        else
            return fgets($this->file,$length);
    }

    /*
     * fwrite函数别名
     */
    public function puts($str)
    {
        return fputs($this->file,$str);
    }

    public function eof()
    {
        return feof($this->file);
    }

    public function seek($offset)
    {
        return fseek($this->file,$offset);
    }

    public function close()
    {
        fclose($this->file);
    }

}