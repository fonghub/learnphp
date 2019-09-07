<?php


namespace Home\Controller;

use Task\Bll\DataStructure\Linear;
use Think\Controller;

class DsController extends Controller
{

    public function index()
    {
        echo 'index';
    }

    public function linear()
    {
        $linear = new Linear();
        $linear->add_item(0,1);
        $linear->add_item(1,2);
        $linear->add_item(1,3);
        $linear->add_item(1,4);
        $linear->add_item(1,5);
        $linear->add_item(1,6);
        $linear->add_item(1,7);
        $linear->get_items();

        $linear->del_item(1);
        $linear->get_items();

        echo $linear->get_item(2)."<br>";

        echo $linear->get_index(6)."<br>";

        $linear->update_item(1,7);
        $linear->get_items();

        $linear->truncate();
        $linear->add_item(0,1);
        $linear->get_items();

    }
}