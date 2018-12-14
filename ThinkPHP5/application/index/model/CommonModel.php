<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\controller\Common;
use think\cache\driver\File;
use think\Config;
class CommonModel extends Model
{
    public $Redis_obj;
    public $File_obj;
    //缓存配置参数
    public $cache_config = [
        //是否支持redis,初始值false，不用配置
        "is_redis" =>false,
        //是否需要缓存，以及哪种缓存
        "if_cache" =>false,
        "if_redis" =>false,
        "if_file" => true
    ];
    public function __construct()
    {
        parent::__construct();
        if(extension_loaded('redis')){
            $this->Redis_obj = new \Redis();
            $this->Redis_obj->connect('127.0.0.1', 6379);
            $this->cache_config['is_redis'] = true;
        }
        $this->File_obj = new File();
        if($this->cache_config['if_cache'] && $this->cache_config['if_redis'] && !$this->cache_config['is_redis']){
            throw new \BadFunctionCallException('不支持redis');
        }
        if($this->cache_config['if_cache'] && $this->cache_config["is_redis"] && $this->cache_config["if_redis"] && $this->cache_config["if_redis"]){
            $this->cache_config['if_file'] = false;
        }
    }
    //顶部栏
    public function top_class_list()
    {
        list(,,$class_list) = $this->get_class_info();
        $class_list = array_filter($class_list,function($v){ return ($v['class_fid'] == 0)?true:false; });
        return $class_list;

    }
    //最新发布
    public function get_blog_latest_publish($limit = 8)
    {
        list(,,$blog_info) = $this->get_blog_info();
        array_multisort(array_column($blog_info,'bloginfo_createtime'),SORT_DESC,$blog_info);
        $blog_info_latest = array_slice($blog_info,0,$limit);
        return $blog_info_latest;
    }
    //点击排行
    public function get_blog_clicknum($limit = 12)
    {
        list(,,$blog_info) = $this->get_blog_info();
        array_multisort(array_column($blog_info,'bloginfo_click'),SORT_DESC,$blog_info);
        $blog_info_clicknum = array_slice($blog_info,0,$limit);
        return $blog_info_clicknum;
    }
    //链接点击排行
    public function get_link_clicknum()
    {
        list(,,$link_info) = $this->get_link_info();
        array_multisort(array_column($link_info,'link_clicknum'),SORT_DESC,$link_info);
        $link_info_clicknum = array_slice($link_info,0,20);
        return $link_info_clicknum;
    }
    //基础数据缓存拿取
    public function get_class_info()
    {
        try {
            $cache_info = CacheKey::get_cache_key('class_info');
            if( $this->cache_config['if_cache'] && $this->cache_config['if_redis'] && $this->Redis_obj->exists($cache_info['key']) ){
                $res = $this->redis_get($cache_info['key']);
            }else if( $this->cache_config['if_cache'] && $this->cache_config['if_file'] && $this->File_obj->has($cache_info['key']) ){
                $res = $this->File_obj->get($cache_info['key']);
            }else{
                $res = Db::table("ns_class")->where("class_status",1)->order('class_oid,class_createtime','desc')->select();
                //文件缓存
                $this->File_obj->set($cache_info['key'],$res,$cache_info['time']);
                //redis缓存
                $this->redis_set($cache_info['key'],$res,$cache_info['time']);
            }
            $code = 0;
            $msg = "ok";
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            $res = [];
        }
        return [$code,$msg,$res];
    }
    public function get_link_info()
    {
        try {
            $cache_info = CacheKey::get_cache_key('link_info');
            if( $this->cache_config['if_cache'] && $this->cache_config['if_redis'] && $this->Redis_obj->exists($cache_info['key']) ){
                $res = $this->redis_get($cache_info['key']);
            }else if( $this->cache_config['if_cache'] && $this->cache_config['if_file'] && $this->File_obj->has($cache_info['key']) ){
                $res = $this->File_obj->get($cache_info['key']);
            }else{
                $res = Db::table("ns_link")->where("link_status",1)->order('link_clicknum,link_createtime','desc')->select();
                //文件缓存
                $this->File_obj->set($cache_info['key'],$res,$cache_info['time']);
                //redis缓存
                $this->redis_set($cache_info['key'],$res,$cache_info['time']);
            }
            $code = 0;
            $msg = "ok";
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            $res = [];
        }
        return [$code,$msg,$res];
    }
    public function get_blog_info()
    {
        try {
            $cache_info = CacheKey::get_cache_key('blog_info');
            if( $this->cache_config['if_cache'] && $this->cache_config['if_redis'] && $this->Redis_obj->exists($cache_info['key']) ){
                $res = $this->redis_get($cache_info['key']);
            }else if( $this->cache_config['if_cache'] && $this->cache_config['if_file'] && $this->File_obj->has($cache_info['key']) ){
                $res = $this->File_obj->get($cache_info['key']);
            }else{
                $res = Db::table("ns_bloginfo")->where("bloginfo_status",1)->order('bloginfo_click','desc')->select();
                $res = array_map(function($v){
                    $v['created_at'] = date("Y-m-d H:i:s",$v['bloginfo_createtime']);
                    $v['date'] = date('Y-m-d',$v['bloginfo_createtime']);
                    $v['time'] = date("H:i:s",$v['bloginfo_createtime']);
                    return $v;
                },$res);
                //文件缓存
                $this->File_obj->set($cache_info['key'],$res,$cache_info['time']);
                //redis缓存
                $this->redis_set($cache_info['key'],$res,$cache_info['time']);
            }
            $code = 0;
            $msg = "ok";
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            $res = [];
        }
        return [$code,$msg,$res];
    }
    public function get_label_info()
    {
        try {
            $cache_info = CacheKey::get_cache_key('label_info');
            if( $this->cache_config['if_cache'] && $this->cache_config['if_redis'] && $this->Redis_obj->exists($cache_info['key']) ){
                $res = $this->redis_get($cache_info['key']);
            }else if( $this->cache_config['if_cache'] && $this->cache_config['if_file'] && $this->File_obj->has($cache_info['key']) ){
                $res = $this->File_obj->get($cache_info['key']);
            }else{
                $res = Db::table("ns_label")->where("label_status",1)->order('label_oid','desc')->select();
                //文件缓存
                $this->File_obj->set($cache_info['key'],$res,$cache_info['time']);
                //redis缓存
                $this->redis_set($cache_info['key'],$res,$cache_info['time']);
            }
            $code = 0;
            $msg = "ok";
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            $res = [];
        }
        return [$code,$msg,$res];
    }
    //redis操作封装
    public function redis_set($key,$val,$time=0)
    {
        $val = is_scalar($val)?$val:serialize($val);
        $this->Redis_obj->set($key,$val) && $this->Redis_obj->expire($key,$time);
    }
    public function redis_get($key)
    {
        $res = unserialize($this->Redis_obj->get($key));
        return $res;
    }


}









































