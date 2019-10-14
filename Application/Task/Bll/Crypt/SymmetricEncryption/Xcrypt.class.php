<?php
namespace Task\Bll\Crypt\SymmetricEncryption;

use Think\Crypt;

/**
 * 使用ThinkPHP的对称加密类
 */
class Xcrypt
{
    private static $key = "abcabc";

    public static function encrypt($data,$encrypt='Des')
    {
        Crypt::init($encrypt);
        return Crypt::encrypt($data,self::$key);
    }

    public static function decrypt($data,$encrypt='Des')
    {
        Crypt::init($encrypt);
        return Crypt::decrypt($data,self::$key);
    }
}