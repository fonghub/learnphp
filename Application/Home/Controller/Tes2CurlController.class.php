<?php


namespace Home\Controller;

class Tes2CurlController
{
    public function index()
    {
        $url1 = "http://127.0.0.1:9090/admin/passport/dologin";
        $cookie = dirname(realpath(APP_PATH)) . "/Public/Common/cookie/cookie_tst.txt";
        $post = array(
            'account' => 'super',
            'password' => 'qweasd123'
        );
        $url2 = "http://127.0.0.1:9090/admin/adminCli/index";
        $content_filepath = dirname(realpath(APP_PATH)) . "/Public/Common/content/content_tst.html";
        echo $content_filepath;
        $this->login_post($url1, $cookie, $post);
        $content = $this->get_content($url2, $cookie);
        file_put_contents($content_filepath, $content);
    }

    //模拟登录
    function login_post($url, $cookie, $post)
    {
        $curl = curl_init();//初始化curl模块
        curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
        curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//是否自动显示返回的信息
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
        curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
        curl_exec($curl);//执行cURL
        curl_close($curl);//关闭cURL资源，并且释放系统资源
    }

    //登录成功后获取数据
    function get_content($url, $cookie)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
        $rs = curl_exec($ch); //执行cURL抓取页面内容
        curl_close($ch);
        return $rs;
    }
}