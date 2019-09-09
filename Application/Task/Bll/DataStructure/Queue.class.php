<?php


namespace Task\Bll\DataStructure;


class Queue extends Linked
{

    public function push($item)
    {
        $length = $this->get_length();
        $this->add_item($length,$item);
    }

    public function shift()
    {
        return $this->del_item(0);
    }
}