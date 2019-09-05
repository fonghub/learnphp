<?php


namespace Cli\Controller;


use Task\Bll\Process\Process1;
use Task\Bll\Process\Process11;
use Task\Bll\Process\Process12;
use Task\Bll\Process\Process2;
use Task\Bll\Process\Process3;
use Task\Bll\Process\Process4;
use Task\Bll\Process\Process6;
use Task\Bll\Process\Process8;
use Task\Bll\Process\Process9;
use Task\Bll\Process\ProcessTst;

class ProcessController
{

    public function p1_index()
    {
        Process1::index();
    }

    public function p2_index()
    {
        Process2::index1();
    }

    public function p3_index()
    {
        Process3::index1();
    }

    public function p4_index()
    {
        Process4::index1();
    }

    public function p6_index()
    {
        Process6::index1();
    }

    public function p8_index()
    {
        Process8::index1();
    }

    public function p9_index()
    {
        Process9::index1();
    }

    public function p11_index()
    {
        Process11::index1();
    }

    public function p12_start()
    {
        Process12::server();
    }

    public function p12_stop()
    {
        Process12::stop();
    }


    public function p12_index1()
    {
        $i = 0;
        while ($i < 100000){
            Process12::client('aac',$i);
            $i++;
        }

    }



    public function pt_index()
    {
        ProcessTst::index1();
    }

}