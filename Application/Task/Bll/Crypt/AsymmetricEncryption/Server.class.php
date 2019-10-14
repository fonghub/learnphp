<?php
namespace Task\Bll\Crypt\AsymmetricEncryption;


/*
 * 服务端类
 */
class Server
{
    private $encrypted = "";//加密后数据
    private $decrypted = "";//解密后数据
    private $pi_key = null;

    public function __construct()
    {
        $this->pi_key = openssl_pkey_get_private(Keys::PRIVATE_KEY);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
    }
    /*
     * 私钥加密
     */
    public function encrypt($data)
    {
        openssl_private_encrypt($data,$this->encrypted,$this->pi_key);//私钥加密
        return base64_encode($this->encrypted);
    }

    /*
     * 私钥解密
     */
    public function decrypt($encrypted)
    {
        openssl_private_decrypt(base64_decode($encrypted),$this->decrypted,$this->pi_key);//公钥加密的内容通过私钥可用解密出来
        return $this->decrypted;
    }
}