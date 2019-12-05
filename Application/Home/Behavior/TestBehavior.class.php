<?php
namespace Home\Behavior;
class TestBehavior
{
    // 行为扩展的执行入口必须是run
    public function run(&$params)
    {
        echo 'RUNTEST BEHAVIOR '.$params;
    }
}
