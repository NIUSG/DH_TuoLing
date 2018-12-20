<?php
namespace app\console\service;
use app\tools\controller\Redis;
use app\tools\model\CacheKeyInfo;
use app\console\model\VisitModel;
class VisitService
{
    private $redis;
    private $M_Visit;
    public function __construct()
    {
        $this->redis = Redis::get_instance();
        $this->M_Visit = new VisitModel();
    }
    public function link()
    {
        $cache_key = CacheKeyInfo::get_cache_key('visit_link_info');
        $link_info = $this->redis->redis_hgetall($cache_key['key']);
        if(empty($link_info)) return;
        //存入数据库数据,已存在的值
        foreach($link_info as $key => $val){
            $db_res = $this->M_Visit->add_link_clicknum($val);
            if($db_res){
                $redis_res = $this->redis->Redis_obj->hdel($cache_key['key'],$key);
            }
        }
    }

    public function blog()
    {
        $cache_key = CacheKeyInfo::get_cache_key('visit_blog_info');
        $blog_info = $this->redis->redis_hgetall($cache_key['key']);
        if(empty($blog_info)) return;
        //存入数据库数据,已存在的值
        foreach($blog_info as $key => $val){
            $db_res = $this->M_Visit->add_blog_clicknum($val);
            if($db_res){
                $redis_res = $this->redis->Redis_obj->hdel($cache_key['key'],$key);
            }
        }
    }

    public function web()
    {
        $cache_key = CacheKeyInfo::get_cache_key('visit_web_info');
        $web_visit_info = $this->redis->redis_hgetall($cache_key['key']);
        if(empty($web_visit_info)) return;
        //写入数据库
        foreach($web_visit_info as $key => $val){
            $db_res = $this->M_Visit->add_ns_visit_cache($key,$val);
            if($db_res){
                $redis_res = $this->redis->Redis_obj->hdel($cache_key['key'],$key);
            }
        }
    }
}