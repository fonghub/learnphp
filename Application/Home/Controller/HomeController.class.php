<?php


namespace Home\Controller;


use Task\Bll\Mail\Mailer;
use Think\Controller;
use Think\Exception;

class HomeController extends Controller
{

    public function index()
    {
        echo 'hello world';
    }

    /*
     * 发送邮件
     */
    public function email()
    {
        try{
            Mailer::initData();
            jsonsuccess('ok','success');
        }catch (Exception $e){
            jsonerror($e->getMessage());
        }
    }
}