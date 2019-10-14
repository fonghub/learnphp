<?php
namespace Task\Bll\NSP\A;


class Invocation
{
    /*
     * 限定名称引用命名空间
     */
    public function child()
    {
        $child = new Sub\Child();
        return $child->index();
    }

    /*
     * 非限定名称
     */
    public function bro()
    {
        $ivo = new Ivo();
        return $ivo->child();
    }
}