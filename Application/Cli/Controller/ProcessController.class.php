<?php


namespace Cli\Controller;


use Think\Log;

class ProcessController
{

    public function getContent()
    {
        echo "\n".'--------start--------'."\n";
        while (true) {
            $str = 'getContent-'.date('Y-m-d H:i:s')."\n";
            Log::write($str);
            sleep(3);
        }
    }

    public function third_way()
    {
        echo "\n".'--------start--------'."\n";
        // $pid = pcntl_fork();
        // if ($pid < 0){
        //     exit('fork error.i='.$pid."\n");
        // }elseif ($pid > 0){
        //     exit('parent process.i='.$pid."\n");
        // }

        // if (!posix_setsid()){
        //     exit('setsid error.');
        // }

        // $pid = pcntl_fork();
        // if ($pid < 0){
        //     exit('fork error.i='.$pid."\n");
        // }elseif ($pid > 0){
        //     exit('parent process.i='.$pid."\n");
        // }

        $i = 1;
        while (true) {
            Log::write($i);
            sleep(1);
            $i++;
        }
    }




    public function tst5()
    {
        $pid = pcntl_fork();
        if ($pid > 0){
//            pcntl_wait($pid);
            // echo "++++children pid={$pid}".PHP_EOL;
            Log::write("++++children pid={$pid}");
        }elseif ($pid == 0){
//            echo "----children pid={$pid}".PHP_EOL;
//            exit;
        }
    }

    public function tst7()
    {
        $ppid = getmypid();
        Log::write('tst6,ppid='.$ppid);
        
        $pid = pcntl_fork();
        // sleep(5);
        if ($pid > 0){
            Log::write("++++children pid={$pid}");
        }elseif ($pid == 0){
           Log::write("----children process running");
        }
    }

    public function tst33()
    {
        for ($i = 1;$i <= 3;$i++){
            $ppid = getmypid();
            $pid = pcntl_fork();
            if ($pid > 0){
                Log::write("parent process,current process id=".$ppid);
            }elseif ($pid == 0){
                Log::write("children process,current process id=".$pid.",parent process id=".$ppid);
            }
        }
    }
}