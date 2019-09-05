<?php


namespace Task\Bll\Process;


use Think\Log;

/*
 * 开启服务端主进程，主进程创建两个子进程
 * 开启客户端，向服务端发送消息，服务端接收消息，返回结果
 * 客户端接收结果
 * 通过ps -axu查看进程，可以发现有一个主进程+两个子进程
 */
class Process12
{

    public static function server() // TODO
    {
        global $child_pid;
        $child_pid = array();
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

        $callback = function (){
            global $child_pid;
            $child_pid_num = count( $child_pid );
            if( $child_pid_num > 0 ){
                foreach( $child_pid as $pid_key => $pid_item ){
                    //查看子进程状态，回收子进程
                    $wait_result = pcntl_waitpid( $pid_item, $status, WNOHANG );
                    if( $wait_result == $pid_item || -1 == $wait_result ){
                        unset( $child_pid[ $pid_key ] );
                    }
                }
            }
        };

        // 父进程安装SIGCHLD信号处理器并分发
        pcntl_signal( SIGCHLD, $callback );

        $forkFunction = function ($listen_socket,$processNum=2){
            global $child_pid;
            // 按照数量fork出固定个数子进程
            for( $i = 1; $i <= $processNum; $i++ ){
                $pid = pcntl_fork();
                if( 0 == $pid ){
                    $pid = getmypid();
                    cli_set_process_title( 'phpserver worker'.$i.' process-'.$pid );
                    while( true ){
                        $conn_socket = socket_accept( $listen_socket );
                        $buf = socket_read($conn_socket,8192);
                        echo 'phpserver worker'.$i.' process-'.$pid.",receive info: $buf\n";
                        $res = 'success';
                        socket_write($conn_socket,$res,strlen($res));
                        socket_close( $conn_socket );
                    }
                }elseif ($pid > 0){
                    $child_pid[] = $pid;
                }
            }
        };
        $forkFunction($listen_socket,2);


        // 主进程不退出，监控子进程的状态
        while( true ){
            pcntl_signal_dispatch();
            $processNum = count($child_pid);
            //保证两个子进程数量
            if ($processNum < 2){
                $forkFunction($listen_socket,2-$processNum);
            }
            sleep( 1 );
        }
        socket_close($listen_socket);
    }


    public static function client($name='xiaoming',$age=20)
    {
        $host = '0.0.0.0';
        $port = 9997;
        $listen_socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
        socket_connect($listen_socket,$host,$port);
        $xiaoming = array(
            'name'=>$name,
            'age'=>$age
        );
        $buf = json_encode($xiaoming);
        socket_write($listen_socket,$buf,strlen($buf));
        $res = socket_read($listen_socket,8192);
        echo $res."\n";
        socket_close($listen_socket);
    }
}