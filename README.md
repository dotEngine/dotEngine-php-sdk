# dotEngine-php-sdk

dotEngine php sdk


#### user example

```
$appsecret = '';

$appkey = '';

$dotEngine = new DotEngine($appkey, $appsecret);

$dotEngine->setConnectTimeout(20); 

$token = $dotEngine->createToken('room', 'user', 36000*24);
```

#### dependency


https://github.com/firebase/php-jwt/blob/master/src/JWT.php


many thanks to @[SN511](https://github.com/SN511)  provide the php version sdk 










