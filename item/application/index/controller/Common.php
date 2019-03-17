<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\CategoryModel;
use app\index\model\BlogModel;
use app\index\model\LinkModel;
use think\Url;
use app\tools\controller\GetIp;
use app\tools\controller\Visit;
use think\cache\driver\Redis;
use think\cache\driver\File;

class Common extends controller
{
    protected $get_ip_obj;
    protected $frame_cache_redis_obj;
    protected $frame_cache_file_obj;
    public function __construct()
    {

        parent::__construct();
        //监听访问信息
        Visit::listen();

        $this->get_ip_obj = new GetIp;
        $this->frame_cache_redis_obj = new Redis;
        $this->frame_cache_file_obj = new File;
        $this->access_restrictions();
        $this->get_top_class_list();
    }
    public function get_top_class_list()
    {
        $M_category = new CategoryModel;
        $top_class_list = $M_category->get_class_list_by_fid(0,'class_title,class_Etitle');
        $top_class_list = array_map(function($v){$v['url'] = "http://".$_SERVER['HTTP_HOST'].Url::build("".$v['class_Etitle']."/index");return $v;},$top_class_list);
        $this->assign('top_class_list',$top_class_list);
        return $this->fetch('public/header');
    }
    public function get_right_list()
    {
        $right_list = [];
        $M_blog = new BlogModel;
        $M_link = new LinkModel;
        $right_list['blog_clicknum'] = $M_blog->get_blog_clicknum();
        $right_list['blog_latest_publish'] = $M_blog->get_blog_latest_publish();
        $right_list['link_clicknum'] = $M_link->get_link_clicknum();
        return $right_list;
    }
    //访问控制
    public function access_restrictions()
    {
        //获取ip,作为redis的key
        $ip_info = $this->get_ip_obj->get_ip();
        $ip = $ip_info['ip'];
        if($this->frame_cache_file_obj->has($ip)){
            if( $this->frame_cache_file_obj->get($ip)>6 ){
                $log_arr['ip'] = $ip;
                $log_arr['msg'] = 'this ip click too rapid';
                $log = '[Common][click_num]['.json_encode($log_arr).']';
                WL($log,'Common');
                $this->error("点击过快，请慢点刷新");
            }
            $this->frame_cache_file_obj->inc($ip);
        }else{
            $this->frame_cache_file_obj->set($ip,'1',5);
        }
    }

}