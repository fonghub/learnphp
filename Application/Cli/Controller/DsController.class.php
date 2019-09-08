<?php


namespace Cli\Controller;


use Task\Bll\DataStructure\Linear;
use Task\Bll\DataStructure\Linked;
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

        echo $linear->get_item(2)."\n";

        echo $linear->get_index(6)."\n";

        $linear->update_item(1,7);
        $linear->get_items();

        $linear->truncate();
        $linear->add_item(0,1);
        $linear->get_items();

    }

    public function linked()
    {
        $link = new Linked();

        $link->add_item(0,'zf');
        $link->add_item(1,20);
        $link->add_item(2,'cl');
        $link->add_item(3,'st');
        $link->add_item(4,'gz');
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $length = $link->get_length();
        echo "length={$length}\n";

        $link->del_item(1);
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $link->interrupt(2);
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";

        $link->truncate();
        $arr = $link->get_items();
        echo "All items: ".json_encode($arr)."\n";
    }
}