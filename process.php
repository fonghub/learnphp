<?php
    echo '--------start--------';
    $pid = pcntl_fork();
    if ($pid < 0){
        exit('fork error.');
    }elseif ($pid > 0){
        exit('parent process.');
    }

    if (!posix_setsid()){
        exit('setsid error.');
    }

    $pid = pcntl_fork();
    if ($pid < 0){
        exit('fork error.');
    }elseif ($pid > 0){
        exit('parent process.');
    }

    for ($i = 1;$i <= 10;$i++){
        sleep(1);
        file_put_contents('daemon.log',$i,FILE_APPEND);
    }