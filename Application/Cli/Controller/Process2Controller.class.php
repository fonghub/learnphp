<?php


namespace Cli\Controller;

/*
 * https://github.com/elarity/advanced-php/blob/master/2.%20php%E5%A4%9A%E8%BF%9B%E7%A8%8B%E5%88%9D%E6%8E%A2---%E5%BC%80%E7%AF%87.md
 */
class Process2Controller
{

    /*
     * 在程序从pcntl_fork()后父进程和子进程将各自继续往下执行代码
     * 在调用完pcntl_fork()后，该函数会返回两个值。
     * 在父进程中返回子进程的进程ID，在子进程内部本身返回数字0。
     */
    public function index1()
    {
        $pid = pcntl_fork();
        if ($pid > 0){
            echo "parent process running".PHP_EOL;
        }elseif ($pid == 0){
            echo "children process running".PHP_EOL;
        }else{
            echo "fork error".PHP_EOL;
        }
    }

    /*
     * 子进程拥有父进程的数据副本，而并不是共享
     */
    public function index2()
    {
        $number = 1;
        $pid = pcntl_fork();
        if ($pid > 0){
            $number += 1;
            echo "parent process running,number={$number}".PHP_EOL;
        }elseif ($pid == 0){
            $number += 20;
            echo "children process running,number={$number}".PHP_EOL;
        }else{
            echo "fork error".PHP_EOL;
        }
    }

    /*
     *子进程分别拥有父进程的数据副本，不共享
     */
    public function index22()
    {
        $number = 1;
        for ($i = 1;$i <= 3;$i++){
            $pid = pcntl_fork();
            if ($pid < 0){
                exit('fork error');
            }elseif ($pid == 0){
                $number += 10;
                exit("children process running,number={$number}".PHP_EOL);
            }else{
//                $number += 1;
//                echo "parent process running,number={$number}".PHP_EOL;
            }
        }
    }

    /*
     * 显示了7次 “ children ”
     */
    public function index3()
    {
        for ($i = 1;$i <= 3;$i++){
            $pid = pcntl_fork();
            if ($pid > 0){
//                echo "parent process running".PHP_EOL;
            }elseif ($pid == 0){
                echo "children process running i=".$i.PHP_EOL;
            }
        }
    }



    /*
     * 显示了3次 “ children ”
     */
    public function index4()
    {
        for ($i = 1;$i <= 3;$i++){
            $pid = pcntl_fork();
            if ($pid > 0){
//                echo "parent process running".PHP_EOL;
            }elseif ($pid == 0){
                echo "children process running i=".$i.PHP_EOL;
                exit;
            }
        }
    }
}