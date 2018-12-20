<?php
namespace app\tools\controller;
use app\tools\controller\GetIp;
use app\tools\controller\Redis;
use app\tools\model\CacheKeyInfo;
class Visit
{
    static public function listenVisit()
    {
        $redis = Redis::get_instance();
        if($redis->Redis_obj == null) return;
        $cache_key = CacheKeyInfo::get_cache_key('visit_web_info');
        $visit_data = self::get_listen_visit_info();
        $hash_key = md5($visit_data['microtime']);
        $res = $redis->redis_hset($cache_key['key'],$hash_key,$visit_data,$cache_key['time']);
        return $res;
    }
    static public function get_listen_visit_info()
    {
        list(,,$data['ip']) = GetIp::get_ip();
        //$data['ip'] = '116.24.66.133';
        $data['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $data['time'] = date('Y-m-d H:i:s');
        $data['microtime'] = microtime(true);
        return $data;
    }
}