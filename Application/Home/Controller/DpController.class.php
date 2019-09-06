<?php


namespace Home\Controller;


use Task\Bll\DP\singleton;
use Think\Controller;

class DpController extends Controller
{

    public function singleton()
    {
        $singleton = new singleton();
        $singleton->index();
    }
}