<?php
namespace Home\Behavior;
class Anotherbhav
{
    // 行为扩展的执行入口必须是run
    public function test_tag(&$params)
    {
        echo 'RUNTEST test_tag '.$params;
    }
}
