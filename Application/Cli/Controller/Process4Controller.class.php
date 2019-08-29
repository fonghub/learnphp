<?php


namespace Cli\Controller;

/*
 * https://github.com/elarity/advanced-php/blob/master/4.%20php%E5%A4%9A%E8%BF%9B%E7%A8%8B%E5%88%9D%E6%8E%A2---%E4%BF%A1%E5%8F%B7.md
 */
class Process4Controller
{

    /*
     * 在父进程不断while循环调用pcntl_waitpid()
     */
    public function index1()
    {
        $pid = pcntl_fork();
        if( 0 > $pid ){
            exit('fork error.'.PHP_EOL);
        } else if( 0 < $pid ) {
            // 在父进程中
            cli_set_process_title('php father process');
            // 父进程不断while循环，去反复执行pcntl_waitpid()，从而试图解决已经退出的子进程
            while( true ){
                sleep( 1 );
                $wait_result=pcntl_waitpid( $pid, $status, WNOHANG );

                //会输出20个0,第21个是子进程退出后返回的子进程号,第22个开始输出-1,
                //那为何第22个开始一直是-1,因为当找不到子进程时,或者错误时是返回-1的,
                //而0只代表当前子进程没有退出
                echo $wait_result.PHP_EOL;
            }
        } else if( 0 == $pid ) {
            // 在子进程中
            // 子进程休眠20秒钟后直接退出
            cli_set_process_title('php child process');
            sleep( 10 );
            exit;
        }
    }

    /*
     * 安装响应信号处理器，pcntl_signal()
     * 让信号处理器运行起来，pcntl_signal_dispatch()
     */
    public function index2()
    {
        $pid = pcntl_fork();
        if( 0 > $pid ){
            exit('fork error.'.PHP_EOL);
        } else if( 0 < $pid ) {
            // 在父进程中
            // 给父进程安装一个SIGCHLD信号处理器
            pcntl_signal( SIGCHLD, function() use( $pid ) {
                echo "收到子进程退出".PHP_EOL;
                pcntl_waitpid( $pid, $status, WNOHANG );
            } );
            cli_set_process_title('php father process');
            // 父进程不断while循环，去反复执行pcntl_waitpid()，从而试图解决已经退出的子进程
            while( true ){
                sleep( 1 );
                // 注释掉原来老掉牙的代码，转而使用pcntl_signal_dispatch()
                //pcntl_waitpid( $pid, $status, WNOHANG );
                pcntl_signal_dispatch();
            }
        } else if( 0 == $pid ) {
            // 在子进程中
            // 子进程休眠20秒钟后直接退出
            cli_set_process_title('php child process');
            sleep( 5 );
            exit;
        }
    }


}