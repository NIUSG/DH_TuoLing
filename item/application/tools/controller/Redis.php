<?php
namespace app\tools\controller;

class Redis
{

    private $host;
    private $port;
    public $Redis_obj = null;
    private static $cur_obj = null;
    private function __construct($host,$port)
    {
        if(extension_loaded('redis')){
            $this->Redis_obj = new \Redis();
            $this->Redis_obj->connect('127.0.0.1', 6379);
        }
    }
    public static function get_instance($host = '127.0.0.1',$port='6379')
    {
        if(is_null(self::$cur_obj)){
            self::$cur_obj = new static($host,$port);
        }
        return self::$cur_obj;
    }
    //redis操作封装
    public function redis_set($key,$val,$time=0)
    {
        $val = is_scalar($val)?$val:serialize($val);
        if($time>0){
            $redis_res = $this->Redis_obj->set($key,$val) && $this->Redis_obj->expire($key,$time);
        }else{
            $redis_res = $this->Redis_obj->set($key,$val);
        }
        return $redis_res;
    }
    //redis hash_set
    public function redis_hset($key,$id,$val,$time=0)
    {
        $val = is_scalar($val)?$val:serialize($val);
        if($time>0){
            $redis_res = $this->Redis_obj->hset($key,$id,$val) && $this->Redis_obj->expire($key,$time);
        }else{
            $redis_res = $this->Redis_obj->hset($key,$id,$val);
        }
        return $redis_res;
    }
    public function redis_get($key)
    {
        $res = unserialize($this->Redis_obj->get($key));
        return $res;
    }
    public function redis_hget($key,$id)
    {
        $res = unserialize($this->Redis_obj->hget($key,$id));
        return $res;
    }
    public function redis_hgetall($key)
    {
        $res = $this->Redis_obj->hgetall($key);
        return $res;
    }
}
