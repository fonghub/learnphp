<?php
namespace  Cli\Controller;
use Task\Bll\Watchmen\PushBroadcast;
use Think\Controller;
use Think\Log;
use Think\Exception;
use Task\Utils\Xcrypt;
use Task\Rabbitmq\ReceiveApi;
use Task\Rabbitmq\ReceiveLog;
use Task\Rabbitmq\Send;
use Task\Test\ServerReceiveApi;
use Task\Bll\Watchmen\Daemon;
use Task\Bll\Watchmen\SendWarning;
use Task\Bll\Watchmen\MakeWarning;
use Task\Bll\Watchmen\RabbitMQ;

class HomeController extends Controller{ 

    public function index($id) {
    	$receiveApi=new ReceiveApi($id);
    	$receiveApi->runReceive();
    }

    public function log($id,$key) {
        $receiveLog=new ReceiveLog($id);
        $receiveLog->runReceive($key);
    }

    #系统守护
    public function daemon(){
        $daemonBll= new Daemon();
        $daemonBll->run();
    }

    public function killall(){
        \Task\Bll\Watchmen\ExecuteTask::doKillAll_v2();
    }

    public function makewarn(){
        $makeWarningBll=new MakeWarning();
        $makeWarningBll->run();
    }

    public function sendwarn(){
        $sendWarningBll=new SendWarning();
        $sendWarningBll->run();
    }

    public function pushbc(){
        $push = new PushBroadcast();
        $push->run();
    }

    public function test(){
        S("ddsfdsf",85);

        while(true){
            echo  S("ddsfdsf");
            sleep(3);
        }

        // Log::write("454");
        // foreach ($_SERVER as $k => $v) {
        //     echo ($_SERVER['REMOTE_ADDR']  ?? "44")." \n";
        // }
        //echo shell_exec("php E:/Git/jp_platform/cli.php Home/index/id/1000 ");
    }
   
}

?>
