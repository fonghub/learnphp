<?php
namespace  Cli\Controller;

use Task\Bll\File\OpenFile;

class HomeController{

    public $ah;
    public function __construct()
    {
        if (empty($this->ah)){
            $fileName = dirname(__DIR__).DIRECTORY_SEPARATOR."Content/test";
            $this->ah = fopen($fileName,'a+');
            echo "__construct \n";
        }
    }

    public function index()
    {

        for ($i=0;$i<10;$i++){
            $pid = pcntl_fork();
            if ($pid < 0){
                exit("fork error");
            }elseif ($pid == 0){
                $pid = getmypid();
                $str = "Hello world,pid={$pid}\n";
                fwrite($this->ah,$str);
                echo "write,pid={$pid}\n";
                exit;
            }
        }
    }
}

?>
