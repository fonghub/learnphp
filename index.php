<?php
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

//define('BUILD_LITE_FILE',true);
define('CDN','');
define('APP_DEBUG',true);
define('APP_PATH','./Application/');
define('BIND_MODULE','Home');
header("charset=utf-8");

require './System/Virgin.php';
