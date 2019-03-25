<?php
namespace  Common\Controller;
use Think\Controller;

abstract class BaseController extends Controller { 
    

    /*错误提示
    $msg 错误提示信息
    $jumpUrl 跳转动作地址 空：后退 0：不跳转 其他：跳转到传入的地址
    $ttl  跳转
    **************************************/
    protected function error($msg='',$jumpUrl='',$ttl=3){
        $isUser=C('URL.ACCOUNT')=='/user';
        $jumpUrl = ((!($jumpUrl===0)||!($jumpUrl==='0')) && empty($jumpUrl)) ? '-1' : $jumpUrl;
        $ttl = round($ttl,2) > 0 ? $ttl : 1;
        $this->assign(get_defined_vars());
        $this->display('./Public/common/template/error.html');
        exit;
    }
    /*信息提示
    $msg 提示信息
    $jumpUrl 跳转动作地址 空：后退 0：不跳转 其他：跳转到传入的地址
    $ttl  跳转  
    **************************************/
    protected function success($msg='',$jumpUrl='',$ttl=2) {
        $isUser=C('URL.ACCOUNT')=='/user';
        //$jumpUrl = ((!($jumpUrl===0)||!($jumpUrl==='0')) && empty($jumpUrl)) ? '-1' : $jumpUrl;
        if(empty($jumpUrl))$jumpUrl=$_SERVER['REQUEST_URI'];
        $ttl = round($ttl,2) > 0 ? $ttl : 1;
        $this->assign(get_defined_vars());
        $this->display('./Public/common/template/success.html');
        exit;
    }

    /*信息提示
    $msg 提示信息
    $jumpUrl 跳转动作地址 ,为null时不跳转
    **************************************/
    protected function alert($msg='',$jumpUrl=null){
        if($jumpUrl==null){
            $script="alert('{$msg}');";
        }
        else{
            $script="alert('{$msg}');top.location.href='{$jumpUrl}';";
        }
        echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" ></head>";
        echo "<script type='text/javascript'>{$script}</script>";
        exit;
    }

    /*最顶层页面跳转
    $jumpUrl 跳转动作地址
    **************************************/
    protected function redirect_top($jumpUrl='') {
        echo "<script type='text/javascript'>top.location.href='{$jumpUrl}';</script>";
        exit;
    }
}
?>
