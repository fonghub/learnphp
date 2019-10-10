<?php
declare(strict_types=1);
namespace Cli\Controller;

// use Task\Bll\Php7NewFeatures\ScalarTypeDeclarations;
// use Task\Bll\Php7NewFeatures\ReturnTypeDeclarations;
// use Task\Bll\Php7NewFeatures\NullCoalescingOperator;
// use Task\Bll\Php7NewFeatures\SpaceshipOperator;
use Task\Bll\Php7NewFeatures\GroupUse\{GroupUse1,GroupUse2,GroupUse3};
use Task\Bll\Php7NewFeatures\{ScalarTypeDeclarations,ReturnTypeDeclarations,NullCoalescingOperator,SpaceshipOperator,ConstantArrays};
use Task\Bll\Php7NewFeatures\AnonymousClasses\Client;

class Php7nfController 
{
    /**
     * 标量类型声明
     */
    public function scalarType()
    {
        try{
            $s = new ScalarTypeDeclarations();
            $res = $s->index(1.1,false,true);
            echo $res;
        }catch(\Exception $e){
            jsonerror($e->getMessage());
        }
    }

    /**
     * 返回值类型声明
     */
    public function returnType()
    {
        $r = new ReturnTypeDeclarations();
        $res = $r->index(1);
        var_dump($res);
    }

    /**
     * null合并操作符
     */
    public function nullCoalescing()
    {
        $n = new NullCoalescingOperator();
        $name = "";
        $res = $n->index();
        var_dump($res);
    }

    /**
     * 太空船操作符
     */
    public function spaceshipOperator()
    {
        $s = new SpaceshipOperator();
        $ai=5;
        $bi=3;
        $af=5.0;
        $bf=3.0;
        $as="5";
        $bs="3";
        $resStr = null;
        $res = $s->index($as,$bs);
        switch($res){
            case -1:
                $resStr = "第一个参数小于第二个参数";
                break;
            case 0:
                $resStr = "第一个参数等于第二个参数";
                break;
            case 1:
                $resStr = "第一个参数大于第二个参数";
                break;
        }
        echo $resStr;
    }

    /**
     * 使用use分组导入处于相同namespace下的类
     * 语法：use 相同的namespace\{Class1,Class2,Class3};
     */
    public function groupUse()
    {
       $gu1 = new GroupUse1();
       echo $gu1->index()."\n";
       $gu2 = new GroupUse2();
       echo $gu2->index()."\n";
       $gu3 = new GroupUse3();
       echo $gu3->index()."\n";
    }
    
    /**
     * 数组常量
     */
    public function constantArrays()
    {
        $ca = new ConstantArrays();
        $ca->index();
        print_r(ANIMALS);
    }

    /**
     * 使用new class实例化匿名类
     */
    public function anonymousClasses()
    {
        $ca = new Client();
        $res = $ca->index();
        print_r($res);
        $res->log("Hello World.");
    }
}