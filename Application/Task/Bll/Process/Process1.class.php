<?php


namespace Task\Bll\Process;


use Think\Log;

/*
 * https://github.com/elarity/advanced-php/blob/master/1.%20php%E8%BF%9B%E7%A8%8Bdaemon%E5%8C%96%E7%9A%84%E6%AD%A3%E7%A1%AE%E5%81%9A%E6%B3%95.md
 */
class Process1
{

    public static function index()
    {
        // 一次fork
        $pid = posix_getpid();
        $fpid = pcntl_fork();
        if ( $fpid < 0 ) {
            exit( ' fork error. ' );
        } else if( $fpid > 0 ) {
            //  父进程返回子进程id
            exit( " parent process. pid={$pid} child pid={$fpid}\n" );
        }
        //  以下为子进程
        $pid = posix_getpid();
        echo " child process. pid={$pid} parent pid=".posix_getppid()."\n";
        // 将当前子进程提升会会话组组长 这是至关重要的一步
        if ( ! posix_setsid() ) {
            exit( ' setsid error. ' );
        }
        // 二次fork
        $fpid = pcntl_fork();
        if( $fpid < 0 ){
            exit( ' fork error. ' );
        } else if( $fpid > 0 ) {
            exit( " parent process. pid={$pid} child pid={$fpid}\n" );
        }
        //  以下为子进程
        $pid = posix_getpid();
        echo " child process. pid={$pid} parent pid=".posix_getppid()."\n";
        // 真正的逻辑代码们 下面仅仅写个循环以示例
        for( $i = 1 ; $i <= 10 ; $i++ ){
            sleep( 1 );
            Log::write('Process1 i='.$i);
        }
    }
}