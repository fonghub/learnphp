<?php


namespace Task\Bll\Process;

/*
 * https://github.com/elarity/advanced-php/blob/master/3.%20php%E5%A4%9A%E8%BF%9B%E7%A8%8B%E5%88%9D%E6%8E%A2---%E5%AD%A4%E5%84%BF%E5%92%8C%E5%83%B5%E5%B0%B8.md
 *
 * 孤儿进程是指父进程在fork出子进程后，自己先完了。
 * 僵尸进程是指父进程在fork出子进程，而后子进程在结束后，父进程并没有调用wait或者waitpid等完成对其清理善后工作，导致该子进程进程ID、文件描述符等依然保留在系统中，极大浪费了系统资源。
*/
class Process3
{
    /*
     * 孤儿进程的出现
     * 孤儿进程被init进程收养
     */
    public static function index1()
    {
        $pid = pcntl_fork();
        if( $pid > 0 ){
            // 显示父进程的进程ID，这个函数可以是getmypid()，也可以用posix_getpid()
            echo "Father PID:".getmypid().PHP_EOL;
            // 让父进程停止两秒钟，在这两秒内，子进程的父进程ID还是这个父进程
            sleep( 2 );
        } else if( 0 == $pid ) {
            // 让子进程循环10次，每次睡眠1s，然后每秒钟获取一次子进程的父进程进程ID
            for( $i = 1; $i <= 10; $i++ ){
                sleep( 1 );
                // posix_getppid()函数的作用就是获取当前进程的父进程进程ID
                echo posix_getppid().PHP_EOL;
            }
        } else {
            echo "fork error.".PHP_EOL;
        }
    }

    /*
     * 僵尸进程的出现
     * 僵尸进程的危害
     */
    public static function index2()
    {
        $pid = pcntl_fork();
        if( $pid > 0 ){
            // 下面这个函数可以更改php进程的名称
            cli_set_process_title('php father process');
            // 让主进程休息60秒钟
            sleep(60);
        } else if( 0 == $pid ) {
            cli_set_process_title('php child process');
            // 让子进程休息10秒钟，但是进程结束后，父进程不对子进程做任何处理工作，这样这个子进程就会变成僵尸进程
            sleep(10);
        } else {
            exit('fork error.'.PHP_EOL);
        }
    }

    /*
     * 通过pcntl_wait()来避免僵尸进程
     */
    public static function index3()
    {
        $pid = pcntl_fork();
        if( $pid > 0 ){
            // 下面这个函数可以更改php进程的名称
            cli_set_process_title('php father process');

            // 返回$wait_result，就是子进程的进程号，如果子进程已经是僵尸进程则为0
            // 子进程状态则保存在了$status参数中，可以通过pcntl_wexitstatus()等一系列函数来查看$status的状态信息是什么
            $wait_result = pcntl_wait( $status );
            print_r( $wait_result );
            print_r( $status );

            // 让主进程休息60秒钟
            sleep(60);
        } else if( 0 == $pid ) {
            cli_set_process_title('php child process');
            // 让子进程休息10秒钟，但是进程结束后，父进程不对子进程做任何处理工作，这样这个子进程就会变成僵尸进程
            sleep(10);
        } else {
            exit('fork error.'.PHP_EOL);
        }
    }


    /*
     * pcntl_waitpid()来避免僵尸进程
     * pcntl_waitpid( $pid, &$status, $option = 0 )
     */
    public static function index4()
    {
        $pid = pcntl_fork();
        if( $pid > 0 ){
            // 下面这个函数可以更改php进程的名称
            cli_set_process_title('php father process');

            // 返回值保存在$wait_result中
            // $pid参数表示 子进程的进程ID
            // 子进程状态则保存在了参数$status中
            // 将第三个option参数设置为常量WNOHANG，则可以避免主进程阻塞挂起，此处父进程将立即返回继续往下执行剩下的代码
            $wait_result = pcntl_waitpid( $pid, $status );
            var_dump( $wait_result );
            var_dump( $status );

            // 让主进程休息60秒钟
            sleep(40);

        } else if( 0 == $pid ) {
            cli_set_process_title('php child process');
            // 让子进程休息10秒钟，但是进程结束后，父进程不对子进程做任何处理工作，这样这个子进程就会变成僵尸进程
            sleep(10);
        } else {
            exit('fork error.'.PHP_EOL);
        }
    }

    /*
     * pcntl_waitpid()来避免僵尸进程
     * pcntl_waitpid( $pid, &$status, $option = 0 )
     * 将第三个option参数设置为常量WNOHANG，则可以避免主进程阻塞挂起，此处父进程将立即返回继续往下执行剩下的代码
     */
    public static function index5()
    {
        $pid = pcntl_fork();
        if( $pid > 0 ){
            // 下面这个函数可以更改php进程的名称
            cli_set_process_title('php father process');

            // 返回值保存在$wait_result中
            // $pid参数表示 子进程的进程ID
            // 子进程状态则保存在了参数$status中
            // 将第三个option参数设置为常量WNOHANG，则可以避免主进程阻塞挂起，此处父进程将立即返回继续往下执行剩下的代码
            $wait_result = pcntl_waitpid( $pid, $status, WNOHANG );

            //$wait_result大于0代表子进程已退出,返回的是子进程的pid,非阻塞时0代表没取到退出子进程,为什么会没有取到子进程,因为当时子进程没有退出,在休眠sleep

            var_dump( $wait_result );
            var_dump( $status );
            echo "不阻塞，运行到这里".PHP_EOL;

            // 让主进程休息60秒钟
            sleep(20);

        } else if( 0 == $pid ) {
            cli_set_process_title('php child process');
            // 让子进程休息10秒钟，但是进程结束后，父进程不对子进程做任何处理工作，这样这个子进程就会变成僵尸进程
            sleep(10);
        } else {
            exit('fork error.'.PHP_EOL);
        }
    }
}