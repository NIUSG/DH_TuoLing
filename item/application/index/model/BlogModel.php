<?php
namespace app\index\model;

use think\Model;
use think\Db;

use app\tools\controller\Redis;
use app\tools\model\CacheKeyInfo;
class BlogModel extends CommonModel
{
    public function index_blog_list($limit = 15)
    {
        $blog_info_list = $this->get_blog_latest_publish($limit);
        return $blog_info_list;
    }
    public function blog_list()
    {
        list(,,$blog_list) = $this->get_blog_info();
        array_multisort(array_column($blog_list,'bloginfo_createtime'),SORT_DESC,$blog_list);
        list(,,$class_list) = $this->get_class_info();
        $blog_list = array_map(function($v)use($class_list){$v['class_title'] = $class_list[$v['class_id']]['class_title'];return $v;},$blog_list);
        return $blog_list;
    }
    public function blog_list_index_class($class_id)
    {
        list(,,$class_list) = $this->get_class_info();
        $class_list_cur = $class_list[$class_id];
        list(,,$blog_list) = $this->get_blog_info();
        $blog_list_cur = array_filter($blog_list,function($v)use($class_id){
            return ($v['class_id'] == $class_id)?true:false;
        });
        $blog_list_cur = array_map(function($v)use($class_list_cur){
            $v['class_title'] = $class_list_cur['class_title'];
            return $v;
        },$blog_list_cur);
        array_multisort(array_column($blog_list_cur,'bloginfo_createtime'),SORT_DESC,$blog_list_cur);
        return $blog_list_cur;
    }
    public function blog_list_index_label($label_id)
    {
        list(,,$blog_label_list) = $this->get_blog_label_info();
        $blog_id_list = $blog_label_list['label_blog_key'][$label_id]['bloginfo_id'];
        list(,,$blog_list) = $this->get_blog_info();
        $blog_list = array_map(function($v)use($blog_list){
            $v = $blog_list[$v];
            return $v;
        },$blog_id_list);
        list(,,$class_list) = $this->get_class_info();
        $blog_list = array_map(function($v)use($class_list){$v['class_title'] = $class_list[$v['class_id']]['class_title'];return $v;},$blog_list);
        return $blog_list;
    }
    public function get_content_info($blog_id)
    {
        try {
            $cache_info = CacheKey::get_cache_key('content_info');
            $cache_info['file_key'] = $cache_info['key']."-".$blog_id;
            if( $this->cache_config['if_cache'] && $this->cache_config['if_redis'] && $this->Redis_obj->hexists($cache_info['key'],$blog_id) ){
                $res = $this->redis_hget($cache_info['key'],$blog_id);
            }else if( $this->cache_config['if_cache'] && $this->cache_config['if_file'] && $this->File_obj->has($cache_info['key']) ){
                $res = $this->File_obj->get($cache_info['file_key']);
            }else{
                $res = $this->content_info($blog_id);
                //文件缓存
                $this->File_obj->set($cache_info['file_key'],$res,$cache_info['time']);
                //redis缓存
                if($this->Redis_obj != null){
                    $this->redis_hset($cache_info['key'],$blog_id,$res,$cache_info['time']);
                }
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

    public function content_info($blog_id)
    {
        $blog_info = Db::table('ns_bloginfo')->where('bloginfo_id',$blog_id)->select();
        $blog_info = $blog_info[0];
        $blog_info['created_at'] = date("Y-m-d H:i:s",$blog_info['bloginfo_createtime']);
        $blog_info['date'] = date('Y-m-d',$blog_info['bloginfo_createtime']);
        $blog_info['time'] = date("H:i:s",$blog_info['bloginfo_createtime']);
        list(,,$class_info) = $this->get_class_info();
        $blog_info['class_title'] = $class_info[$blog_info['class_id']]['class_title'];
        list(,,$label_info) = $this->get_label_info();
        list(,,$blog_label_info) = $this->get_blog_label_info();
        $blog_label_info = $blog_label_info['blog_label_key'];
        $label_list = isset($blog_label_info[$blog_id]['label_id'])?$blog_label_info[$blog_id]['label_id'] :[];
        $label_list = array_map(function($v)use($label_info){
            $v = $label_info[$v];return $v;
        },$label_list);
        $blog_info['label_list'] = $label_list;
        $bloglink_url = Db::table('ns_blog_link')->where("bloginfo_id",$blog_id)->select();
        $bloglink_url = array_column($bloglink_url,'bloglink_url');
        $blog_info['bloglink_url'] = $bloglink_url;
        $content = Db::table('ns_blogcontent')->where('bloginfo_id',$blog_id)->find();
        $content = $content['blogcontent_ctt'];
        $blog_info['content'] = $content;
        return $blog_info;
    }

    public function record_visit_blog($blog_id)
    {
        $redis = Redis::get_instance();
        if($redis->Redis_obj == null) return;
        $cache_key = CacheKeyInfo::get_cache_key('visit_blog_info');
        $hash_key = md5(microtime(true));
        $res = $redis->redis_hset($cache_key['key'],$hash_key,$blog_id,$cache_key['time']);
        return $res;
    }
}



















































