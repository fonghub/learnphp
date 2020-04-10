<?php
namespace Task\Bll\Process;

//  使用消息队列在进程间通信
class Process8m
{
    const MSG_TYEP = 1;
    public $queueNum;       //  子进程数量
    public $chilpid;        //  子进程id数组

    public function __construct($queueNum = 5)
    {
        $this->queueNum = $queueNum;    
        $this->chilpid = [];            

        $this->stop();
        self::daemon();
        cli_set_process_title("parent processMQ ".posix_getpid()."\n");
        $this->init();
    }

    //  守护进程
    public static function daemon()
    {
        // 设置umask为0，这样，当前进程创建的文件权限则为777
        umask( 0 );
        $pid = pcntl_fork();
        if( $pid < 0 ){
            exit('fork error.');
        } else if( $pid > 0 ) {
            // 主进程退出
            exit();
        }
        if( !posix_setsid() ){
            exit('setsid error.');
        }
        $pid = pcntl_fork();
        if( $pid  < 0 ){
            exit('fork error');
        } else if( $pid > 0 ) {
            // 主进程退出
            exit;
        }
    }

    public function init()
    {
        for($i=0;$i<$this->queueNum;$i++)
        {
            $pid = $this->createProcess($i);
            $this->chilpid[$i] = $pid;
            // echo "create child process {$pid}\n";
            \Think\Log::write("create child process {$pid}\n");
        }

        pcntl_signal( SIGCHLD, function(){
            $child_pid_num = count( $this->chilpid );
            if( $child_pid_num > 0 ){
                foreach( $this->chilpid as $pid_key => $pid_item ){
                    $wait_result = pcntl_waitpid( $pid_item, $status, WNOHANG );
                    if( $wait_result == $pid_item || -1 == $wait_result ){
                        // 检测子进程，当发现某个子进程故障的时候，马上创建一个新的子进程替换，并把进程和消息队列对应上
                        $this->chilpid[ $pid_key ] = $this->createProcess($pid_key);
                    }
                }
            }
        } );

        while( true ){
            pcntl_signal_dispatch();
            sleep(5);
            // print_r($this->chilpid);
            \Think\Log::write(json_encode($this->chilpid)."\n");
        }
    }

    public function createProcess($i)
    {
        $fpid = pcntl_fork();
        if($fpid < 0){
            exit("fork error\n");
        }elseif($fpid == 0){
            cli_set_process_title("child processMQ {$i}");

            $mqhandle = $this->createMQ($i);

            $this->consumer($mqhandle);

            exit("child process ".posix_getpid()." end\n");
        }else{
            return $fpid;
        }
    }

    //  创建 或者 获取消息队列连接句柄
    public function createMQ($i)
    {
        $key = self::getMQkey($i);
        $mqhandle = msg_get_queue($key);
        // echo "queue = {$key}\n";
        \Think\Log::write("queue = {$key}\n");
        return $mqhandle;
    }

    //  生产消息队列参数 唯一key
    public static function getMQkey($i)
    {
        return ftok(__FILE__, 'm') + $i;
    }

    //  消费消息队列
    public function consumer($mqhandle)
    {
        while(true){
            $res = msg_receive($mqhandle, self::MSG_TYEP, $msgType, 1024, $sendText);
            if($res){
                // echo "child process ".posix_getpid()." receive msg ";
                \Think\Log::write("child process ".posix_getpid()." receive msg ");
                // echo $sendText."\n";
                \Think\Log::write($sendText."\n");
            }
        }
    }

    //  生产者
    public static function producer($num = 5)
    {
        self::daemon();
        cli_set_process_title("producer processMQ ".posix_getpid()."\n");
        $mq_handle = [];
        $queueNum = $num;
        while(true)
        {
            $i = time()%$queueNum;
            if(!isset($mq_handle[$i]))
            {
                $key = self::getMQkey($i);
                $mq_handle[$i] = msg_get_queue($key);
            }

            $data = array(
                'name'=>"nick_".time(),
                'id'=>time()
            );
            $sendText = json_encode($data);
            msg_send($mq_handle[$i], self::MSG_TYEP, $sendText);
            sleep(1);
        }
    }

    //  清理进程
    public function stop()
    {
        shell_exec("ps axopid,cmd|grep processMQ|grep -v grep|awk '{print $1}'|xargs kill -9");
    }

}

?>