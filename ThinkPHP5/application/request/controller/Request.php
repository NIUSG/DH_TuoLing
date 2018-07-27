<?php
namespace app\request\controller;
class Request
{
    const TIMEOUT = 10;
    public static function curl_get($url,$timeout="")
    { 
        $errno = -1;$error = '系统错误';$data = [];
        try {
                $timeout = empty($timeout)?self::TIMEOUT:$timeout;
                $start_at = microtime(true);
                $handle = curl_init();
                curl_setopt($handle,CURLOPT_URL,$url);
                curl_
            } catch (Exception $e) {
                 
            }     
    }
    public static function curl_post()
    { 

    }
}
