<?php


namespace Home\Controller;


class TraitTesController
{
    public function index()
    {
        $gz = new GzController();
        $gz->sayHello();
    }
}