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

    /*
     * 在程序从pcntl_fork()后父进程和子进程将各自继续往下执行代码
     */
    public function tst1()
    {
        $pid = pcntl_fork();
        if ($pid > 0){
            echo "parent pid={$pid}".PHP_EOL;
        }elseif ($pid == 0){
            echo "children pid={$pid}".PHP_EOL;
        }else{
            echo "fork error".PHP_EOL;
        }
    }

    /*
     * 子进程拥有父进程的数据副本，而并不是共享
     */
    public function tst2()
    {
        $number = 1;
        $pid = pcntl_fork();
        if ($pid > 0){
            $number += 1;
            echo "parent pid={$pid},number={$number}".PHP_EOL;
        }elseif ($pid == 0){
            $number += 2;
            echo "children pid={$pid},number={$number}".PHP_EOL;
        }else{
            echo "fork error".PHP_EOL;
        }
    }

    /*
     * 显示了7次 “ children ”
     */
    public function tst3()
    {
        for ($i = 1;$i <= 3;$i++){
            $pid = pcntl_fork();
            if ($pid > 0){
                echo "++++parent pid={$pid}".PHP_EOL;
            }elseif ($pid == 0){
                echo "----children pid={$pid}".PHP_EOL;
            }
        }
    }


    /*
     * 显示了3次 “ children ”
     */
    public function tst4()
    {
        for ($i = 1;$i <= 3;$i++){
            $pid = pcntl_fork();
            if ($pid > 0){
//                echo "++++parent pid={$pid}".PHP_EOL;
            }elseif ($pid == 0){
                echo "----children pid={$pid}".PHP_EOL;
                exit;
            }
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