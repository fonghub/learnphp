<?php


namespace Task\Bll\Process;

/*
 * https://github.com/elarity/advanced-php/blob/master/8.%20php%E5%A4%9A%E8%BF%9B%E7%A8%8B%E5%88%9D%E6%8E%A2---%E8%BF%9B%E7%A8%8B%E9%97%B4%E9%80%9A%E4%BF%A1%E4%BA%8C%E4%B8%89%E4%BA%8B.md
 */
class Process8
{
    const SHM_VAR = 1;
    /*
     * 命名管道
     */
    public static function index1()
    {
        // 管道文件绝对路径
        $pipe_file = APP_PATH.'../Public/Common/content' . DIRECTORY_SEPARATOR . 'test.pipe';
        // 如果这个文件存在，那么使用posix_mkfifo()的时候是返回false，否则，成功返回true
        if (!file_exists($pipe_file)) {
            if (!posix_mkfifo($pipe_file, 0666)) {
                exit('create pipe error.' . PHP_EOL);
            }
        }
        // fork出一个子进程
        $pid = pcntl_fork();
        if ($pid < 0) {
            exit('fork error' . PHP_EOL);
        } else if (0 == $pid) {
            // 在子进程中
            // 打开命名管道，并写入一段文本
            $file = fopen($pipe_file, "w");
            fwrite($file, "helo world.");
            exit;
        } else if ($pid > 0) {
            // 在父进程中
            // 打开命名管道，然后读取文本
            $file = fopen($pipe_file, "r");
            // 注意此处fread会被阻塞
            $content = fread($file, 1024);
            echo $content . PHP_EOL;
            // 注意此处再次阻塞，等待回收子进程，避免僵尸进程
            pcntl_wait($status);
        }

    }

    /*
     * 消息队列
     */
    public static function index2()
    {
        // 使用ftok创建一个键名，注意这个函数的第二个参数“需要一个字符的字符串”
        /*
        共享内存，消息队列，信号量它们三个都是找一个中间介质，来进行通信的，这种介质多的是。
        就是怎么区分出来，就像唯一一个身份证来区分人一样。你随便来一个就行，就是因为这。
        只要唯一就行，就想起来了文件的设备编号和节点，它是唯一的，但是直接用它来作识别好像不太好，不过可以用它来产生一个号。ftok()就出场了。
        */

        $key = ftok( __DIR__, 'a' );
        // 然后使用msg_get_queue创建一个消息队列
        $queue = msg_get_queue( $key, 0666 );
        // 使用msg_stat_queue函数可以查看这个消息队列的信息，而使用msg_set_queue函数则可以修改这些信息
        //var_dump( msg_stat_queue( $queue ) );
        // fork进程
        $pid = pcntl_fork();
        if( $pid < 0 ){
            exit( 'fork error'.PHP_EOL );
        } else if( $pid > 0 ) {
            // 在父进程中
            // 使用msg_receive()函数获取消息
            msg_receive( $queue, 0, $msgtype, 1024, $message );
            echo $message.PHP_EOL;
            // 用完了记得清理删除消息队列
            msg_remove_queue( $queue );
            pcntl_wait( $status );
        } else if( 0 == $pid ) {
            // 在子进程中
            // 向消息队列中写入消息
            // 使用msg_send()向消息队列中写入消息，具体可以参考文档内容
            msg_send( $queue, 1, "hello world" );
            exit;
        }
    }

    /*
     * 信号量与共享内存
     */
    public static function index3()
    {
        // sem key
        $sem_key = ftok( __FILE__, 'b' );
        $sem_id = sem_get( $sem_key );
        // shm key
        $shm_key = ftok( __FILE__, 'm' );
        $shm_id = shm_attach( $shm_key, 1024, 0666 );
//        const SHM_VAR = 1;
        $child_pid = [];
        // fork 2 child process
        for( $i = 1; $i <= 2; $i++ ){
            $pid = pcntl_fork();
            //其实在fork后,子进程也会继承父进程的变量与资源,
            //在子进程echo SHM_VAR就知道了
            if( $pid < 0 ){
                exit();
            } else if( 0 == $pid ) {
                // 获取锁
                sem_acquire( $sem_id );
                if( shm_has_var( $shm_id, self::SHM_VAR ) ){
                    //shm_get_var第二参数必须是int型

                    $counter = shm_get_var( $shm_id, self::SHM_VAR );
                    $counter += 1;
                    shm_put_var( $shm_id, self::SHM_VAR, $counter );
                } else {
                    $counter = 1;
                    shm_put_var( $shm_id, self::SHM_VAR, $counter );
                }
                /*
                有人可能不明白为什么既然某个子进程获取到锁了,在if里面都设置shm_put_var,
                其实程序是这样运行:第一,fork后,假如A子进程先到达(A,B子进程到达顺序由底层某些算法决定的),A子进程去共享内存找一个SHM_VAR值,发现没有,
                就进入else{}里面shm_put_var,设置SHM_VAR为 $counter = 1.释放锁后,进程退出
                B子进程发现现在没有锁住了,我自已先加锁,查找有无SHM_VAR值,刚好发现有值,就+1,并更新SHM_VAR值了
                */
                // 释放锁，一定要记得释放，不然就一直会被阻锁死
                sem_release( $sem_id );
                exit;
            } else if( $pid > 0 ) {
                $child_pid[] = $pid;
            }
        }
        while( !empty( $child_pid ) ){
            foreach( $child_pid as $pid_key => $pid_item ){
                $wait_result=pcntl_waitpid( $pid_item, $status, WNOHANG );
                //必须判断子进程回收的状态,如果不加判断,第一次两个子进程返回都是0,直接unset后会无法进入while,导致僵尸进程
                if($wait_result == -1 || $wait_result > 0)
                    unset( $child_pid[ $pid_key ] );
            }
        }
        // 休眠2秒钟，2个子进程都执行完毕了
        sleep( 2 );
        echo '最终结果'.shm_get_var( $shm_id, self::SHM_VAR ).PHP_EOL;
        // 记得删除共享内存数据，删除共享内存是有顺序的，先remove后detach，顺序反过来php可能会报错
        shm_remove( $shm_id );
        shm_detach( $shm_id );
    }
}