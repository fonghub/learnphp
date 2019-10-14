<?php


namespace Cli\Controller;


use Task\Bll\Crypt\AsymmetricEncryption\Client;
use Task\Bll\Crypt\AsymmetricEncryption\Server;
use Task\Bll\Crypt\Hash;
use Task\Bll\Crypt\SymmetricEncryption\Xcrypt;

class CryptController
{
    private $input = "Sunday";
    private $output = null;


    public function hash_md5()
    {
        $this->output = Hash::hash_md5($this->input);
    }

    public function hash_sha1()
    {
        $this->output = Hash::hash_sha1($this->input);
    }

    /*
     * 对称加密
     */
    public function se_enc()
    {
        $this->output = Xcrypt::encrypt($this->input,'Think');
    }

    /*
    * 对称解密
    */
    public function se_dec($data)
    {
        $this->output = Xcrypt::decrypt($data,'Think');
    }

    /*
     * 非对称客户端公钥加密
     */
    public function ase_c_pu_enc()
    {
        $client = new Client();
        $this->output = $client->encrypt($this->input);
    }

    /*
     * 非对称客户端公钥解密
     */
    public function ase_c_pu_dec($data)
    {
        $client = new Client();
        $this->output = $client->decrypt($data);
    }

    /*
     * 非对称服务端私钥解密
     */
    public function ase_s_pi_dec($data)
    {
        $server = new Server();
        $this->output = $server->decrypt($data);
    }

    /*
     * 非对称服务端私钥加密
     */
    public function ase_s_pi_enc()
    {
        $server = new Server();
        $this->output = $server->encrypt($this->input);
    }

    public function __destruct()
    {
        echo $this->output;
    }
}