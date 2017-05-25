<?php
namespace Library;
use Firebase\JWT\JWT;
class DotEngine{


    private $appkey = "";
    private $appsecret = "";
    private $connectTimeout = 10; //单位s

    /**
     * 架构方法 设置参数
     * @param $appkey
     * @param $appsecret
     */
    public function __construct($appkey, $appsecret){
        $this->appsecret = $appsecret;
        $this->appkey = $appkey;
    }

    /**
     *  default 10s
     * @param connectTimeout connect timeout
     */
    public function setConnectTimeout($connectTimeout){
        $this->connectTimeout = $connectTimeout;
    }

    /**依赖：https://github.com/firebase/php-jwt/blob/master/src/JWT.php
     * @param $room 房间号
     * @param $user 用户名
     * @param $expires 房间有效时间 默认36000*24
     * @return string  token
     */
    public function createToken($room, $user, $expires){
        vendor('JWT.JWT');
        $params['room'] = $room;
        $params['user'] = $user;
        $params['appkey'] = $this->appkey;
        $params['expires'] = $expires;
        $params['nonce'] = rand(0,9999999);
        $sign = JWT::encode($params, $this->appsecret);
        $post_data = array(
            'appkey'=>$this->appkey,
            'sign'=>$sign
        );
        $url = 'https://janus.dot.cc/api/createToken';
        return $this->send_post($url, $post_data);

    }

    /**
     * POST方法获取token
     * @param $url https://janus.dot.cc/api/createToken
     * @param $post_data array('appkey'=>$appkey,'sign'=>$sign)
     * @return bool|string token
     */
    private function send_post($url, $post_data){
        $post_data = http_build_query($post_data);
        $options = array(
            'http'=>array(
                'method'=>'POST',
                'header'=>'Content-type:application/x-www-form-urlencoded',
                'content'=>$post_data,
                'timeout'=>$this->connectTimeout,
            )
        );
        $context = stream_context_create($options);
        $token = file_get_contents($url, false, $context);
        return $token;
    }


}