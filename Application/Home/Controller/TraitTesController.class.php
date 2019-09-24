<?php


namespace Home\Controller;


use Task\Bll\Trait1\Cxk;
use Task\Bll\Trait1\Dancer;
use Task\Bll\Trait1\Singer;

/*
 * https://www.php.net/traits
 */
class TraitTesController
{
    public function singer()
    {
        $singer = new Singer();
        echo $singer->singing()."<br>";
    }

    public function dancer()
    {
        $dancer = new Dancer();
        echo $dancer->dancing()."<br>";
    }

    public function cxk()
    {
        $cxk = new Cxk();
        echo $cxk->singing()."<br>";
        echo $cxk->dancing()."<br>";
        echo $cxk->rap()."<br>";
        echo $cxk->playing()."<br>";
    }
}