<?php
namespace Cli\Controller;


use Task\Bll\NSP\A\Invocation;
use Think\Controller;
use Task\Bll\NSP\A\FileUpload as Afu; 
use Task\Bll\NSP\B\FileUpload as Bfu;

/*
 * 参考：https://lvwenhan.com/php/401.html
 */
class NSPController extends Controller
{
    public function index(){
        echo "123";
    }

    /**
     * 不同命名空间，相同类名
     * use语法后面跟可选的[as alise],默认省略，并且alise=类名，调用的时候就使用alise
     * 当出现相同类名的时候，别名的作用就体现了
     */
    public function ind1()
    {
        $afu = new Afu();
        $afu->upl();
        echo PHP_EOL;
        $bfu = new Bfu();
        $bfu->upl();
    }

    /**
     * 使用命名空间调用函数
     * 需要注意的是，调用的时候，需要加上跟命名空间（第一个 \ ）,不然调用失败，报错
     */
    public function ind2()
    {
        include APP_PATH."Task/Bll/NSP/A/Func.class.php";
        $res = \Task\Bll\NSP\A\tst();
        echo $res;
    }


    /**
     * 使用命名空间调用常量
     */
    public function ind3()
    {
        include APP_PATH."Task/Bll/NSP/A/Cons.class.php";
        $res = \Task\Bll\NSP\A\FUNC_NAME;
        echo $res;
    }

    /**
     * 命名空间的三种引用方式
     * 1.非限定名称  ：具有相同命名空间的类之间可以直接调用
     * 2.限定名称    ：具有相同的父级命名空间
     * 3.完全限定名称 ：使用use关键字引用，一半都是用这种方式引用
     */
    public function ind4()
    {
        $ivo = new Invocation();
        //限定名称
        $res = $ivo->child();
        echo $res;
        echo PHP_EOL;
        //非限定名称
        $res = $ivo->bro();
        echo $res;
    }
}