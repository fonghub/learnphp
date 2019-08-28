<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

define('APP_DEBUG',true);
//定义命令行模式执行
define('APP_MODE','cli');
//定义模块名
define('BIND_MODULE','Cli');
// 定义应用目录（linux下需要写绝对目录）
define( 'APP_PATH', dirname(__FILE__).'/Application/' );
//不超时
ini_set('default_socket_timeout', -1);
//define('APP_PATH','./Application/');
require dirname(__FILE__).'/System/Virgin.php';


?>