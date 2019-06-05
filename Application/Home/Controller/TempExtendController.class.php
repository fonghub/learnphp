<?php


namespace Home\Controller;


use Think\Controller;
/*
 * 动态模板继承
 */
class TempExtendController extends Controller
{
    public function index($id=1001)
    {
        $this->assign('title','动态模板继承');
        $this->assign('itemid',$id);
        $this->assign('temp_html','index'.$id);
        $this->assign('temp_js','js'.$id);
        $this->display();
    }
}