<?php
namespace Task\Bll\Crypt\AsymmetricEncryption;


/*
 * 客户端类
 */
class Client
{
    private $encrypted = "";//加密后数据
    private $decrypted = "";//解密后数据
    private $pu_key = null;

    public function __construct()
    {
        $this->pu_key = openssl_pkey_get_public(Keys::PUBLIC_KEY);//这个函数可用来判断公钥是否是可用的
    }
    /*
     * 公钥加密
     */
    public function encrypt($data)
    {
        openssl_public_encrypt($data,$this->encrypted,$this->pu_key);//公钥加密
        return base64_encode($this->encrypted);
    }

    /*
     * 公钥解密
     */
    public function decrypt($encrypted)
    {
        openssl_public_decrypt(base64_decode($encrypted),$this->decrypted,$this->pu_key);//私钥加密的内容通过公钥可用解密出来
        return $this->decrypted;
    }
}