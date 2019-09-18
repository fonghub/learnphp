<?php
namespace Task\Bll\Mail;

use Task\Sdk\PHPMailer\Exception;
use Task\Sdk\PHPMailer\PHPMailer;

class Mailer
{

    public static function initData()
    {
        $fromData = array(
            'nickname'=>'master'
        );

        $toData = array(
            array(
                'address'=>'123456789@qq.com',
                'nickname'=>'123456789'
            ),
            array(
                'address'=>'987654333@qq.com',
                'nickname'=>'987654333'
            )
        );
        $title = 'This is a test mail';
        $content = 'content<br>content!';
        self::send($fromData,$toData,$title,$content);
    }

    public static function send($from,$to,$title,$content)
    {
        $mail = new PHPMailer(true);
        $config = self::getConf();
        try{
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Host = $config['host'];
            $mail->Hostname = $config['hostname'];
            $mail->Username = $config['address'];
            $mail->Password = $config['password'];
            $mail->CharSet = $config['charset'];

            //Recipients
            $mail->setFrom($config['address'], $from['username'].'(system)');

            foreach ($to as $v){
                $mail->addAddress($v['address'], $v['username']);
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $content;

            $mail->send();

        }catch (Exception $e){
            E("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    public static function getConf()
    {
        return array(
            'host'=>'smtp.163.com',
            'hostname'=>'mail.163.com',
            'address'=>'123123123@163.com',
            'password'=>'123123123',//授权码
            'charset'=>'UTF-8'
        );
    }
}