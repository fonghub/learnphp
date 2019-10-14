<?php
namespace Task\Bll\Crypt;

class Hash
{
    public static function hash_md5($str,$row_output=false)
    {
        return md5($str,$row_output);
    }

    public static function hash_sha1($str,$row_output=false)
    {
        return sha1($str,$row_output);
    }
}