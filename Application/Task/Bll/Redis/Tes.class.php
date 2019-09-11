<?php
namespace Task\Bll\Redis;

class Tes
{

    public $item = null;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }
}