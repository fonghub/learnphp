<?php


namespace Cli\Controller;



use Task\Bll\DP\Singleton;
use Think\Controller;

class DpController extends Controller
{

    public function index()
    {
        echo 'index';
    }

    public function singleton()
    {
        for ($i = 0; $i < 20; $i++){
            $vhost = rand(1,2);
            $sl = Singleton::getInstance($vhost);
            $res = $sl->getVhost();
            echo "$res\n";
        }
    }
}