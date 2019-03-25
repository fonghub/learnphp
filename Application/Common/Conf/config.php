<?php
return array(

    //部门,产品部放在最后,部门id顺序增长
    'DEPARTMENT'=>array(
        '1'=>array('id'=>1,'name'=>'开发部','order'=>1),
        '2'=>array('id'=>2,'name'=>'美术部','order'=>2),
        '3'=>array('id'=>3,'name'=>'测试部','order'=>3),
        '4'=>array('id'=>4,'name'=>'产品部','order'=>4)
    ),
    //服务器
    'SERVERS'=>array(
        '1'=>array('id'=>1,'name'=>'SIT测试','order'=>1),
        '2'=>array('id'=>2,'name'=>'UAT测试','order'=>2),
        '3'=>array('id'=>3,'name'=>'PPRO测试','order'=>3),
        '4'=>array('id'=>4,'name'=>'正式服测试','order'=>4)
    ),
    //项目
    'PROJECTS'=>array(
        '1'=>array('id'=>1,'ch_name'=>'棋牌','en_name'=>'CHESS'),
        '2'=>array('id'=>2,'ch_name'=>'房卡','en_name'=>'CARD'),
        '3'=>array('id'=>3,'ch_name'=>'老虎机','en_name'=>'SLOT')
    ),

    'EMAIL_SETTINGS'=>array(
//        'host'=>'smtp.mail.jinpin.com',
        'host'=>'10.0.0.85',
        'hostname'=>'mail.jinpin.com',
        'address'=>'testing@mail.jinpin.com',
        'password'=>'123456',
        'charset'=>'UTF-8',
    ),


);