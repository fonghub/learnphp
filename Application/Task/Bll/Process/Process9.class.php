<?php


namespace Task\Bll\Process;

/*
 * https://github.com/elarity/advanced-php/blob/master/9.%20PHP%20Socket%E5%88%9D%E6%8E%A2---%E5%85%88%E4%BB%8E%E4%B8%80%E4%B8%AA%E7%AE%80%E5%8D%95%E7%9A%84socket%E6%9C%8D%E5%8A%A1%E5%99%A8%E5%BC%80%E5%A7%8B.md
 */
class Process9
{

    /*
     * 最简单socket服务器
     */
    public static function index1()
    {
        $host = '0.0.0.0';
        $port = 9990;
        // 创建一个tcp socket
        $listen_socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
        // 将socket bind到IP：port上
        socket_bind( $listen_socket, $host, $port );
        // 开始监听socket
        socket_listen( $listen_socket );
        // 进入while循环，不用担心死循环死机，因为程序将会阻塞在下面的socket_accept()函数上
        while( true ){
            // 此处将会阻塞住，一直到有客户端来连接服务器。阻塞状态的进程是不会占据CPU的
            /*
             之所以不会占据CPU,因为CPU运算的时候,类似有个指挥官的家伙会调度,进程切换,简称调度,
            它只会指挥准备开始打战和正在打战的人,而正在休息军人(阻塞中)不需要命令他们打战,这样也符合常理了
            你也可以看到下图,调度只在运行和就绪之间的,所以cpu不会傻傻等正在休息的士兵起来了,在再指挥
            */
            // 所以你不用担心while循环会将机器拖垮，不会的
            $connection_socket = socket_accept( $listen_socket );
            // 向客户端发送一个helloworld
            $msg = "hello world\r\n";
            socket_write( $connection_socket, $msg, strlen( $msg ) );
            socket_close( $connection_socket );
        }
        socket_close( $listen_socket );
    }

    /*
     * 最简单socket服务器
     * 多进程
     */
    public static function index2()
    {
        $host = '0.0.0.0';
        $port = 9999;
        // 创建一个tcp socket
        $listen_socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
        // 将socket bind到IP：port上
        socket_bind( $listen_socket, $host, $port );
        // 开始监听socket
        socket_listen( $listen_socket );
        // 进入while循环，不用担心死循环死机，因为程序将会阻塞在下面的socket_accept()函数上
        while( true ){
            // 此处将会阻塞住，一直到有客户端来连接服务器。阻塞状态的进程是不会占据CPU的
            // 所以你不用担心while循环会将机器拖垮，不会的
            $connection_socket = socket_accept( $listen_socket );
            // 当accept了新的客户端连接后，就fork出一个子进程专门处理
            $pid = pcntl_fork();
            // 在子进程中处理当前连接的请求业务
            if( 0 == $pid ){
                // 向客户端发送一个helloworld
                $msg = "helloworld\r\n";
                socket_write( $connection_socket, $msg, strlen( $msg ) );
                // 休眠5秒钟，可以用来观察时候可以同时为多个客户端提供服务
                echo time().' : a new client'.PHP_EOL;
//                sleep( 5 );
                socket_close( $connection_socket );
                exit;
            }
        }
        socket_close( $listen_socket );
    }

    /*
     *
     * 最简单socket服务器
     * 多进程
     * 固定数量的子进程
     */
    public static function index3() // TODO
    {
        $host = '0.0.0.0';
        $port = 9997;
        // 创建一个tcp socket
        $listen_socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
        // 将socket bind到IP：port上
        socket_bind( $listen_socket, $host, $port );
        // 开始监听socket
        socket_listen( $listen_socket );
        // 给主进程换个名字
        cli_set_process_title( 'phpserver master process' );
        // 按照数量fork出固定个数子进程
        for( $i = 1; $i <= 10; $i++ ){
            $pid = pcntl_fork();
            if( 0 == $pid ){
                $pid = getmypid();
                cli_set_process_title( 'phpserver worker'.$i.' process-'.$pid );
                while( true ){
                    $conn_socket = socket_accept( $listen_socket );
                    $msg = "helloworld-{$pid}\r\n";
                    socket_write( $conn_socket, $msg, strlen( $msg ) );
                    socket_close( $conn_socket );
                }
            }
        }
        // 主进程不可以退出，代码演示比较粗暴，为了不保证退出直接走while循环，休眠一秒钟
        // 实际上，主进程真正该做的应该是收集子进程pid，监控各个子进程的状态等等
        while( true ){
            sleep( 1 );
        }
        socket_close($listen_socket);
    }
}