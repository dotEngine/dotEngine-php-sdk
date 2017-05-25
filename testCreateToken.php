<?php

//use explame
$appsecret = '';
$appkey = '';
$dotEngine = new DotEngine($appkey, $appsecret);
$dotEngine->setConnectTimeout(20); //默认10s
$token = $dotEngine->createToken('room', 'user', 36000*24);

//dependency
//https://github.com/firebase/php-jwt/blob/master/src/JWT.php