<?php
namespace Task\Bll\Redis;

class Tes
{

    public $item = null;
    public $vohst = null;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setVhost($vohost)
    {
        $this->vohst = $vohost;
    }
}