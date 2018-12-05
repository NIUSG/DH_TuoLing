<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Url;
use app\visit\controller\Write;
use app\helper\controller\GetIp;
class Common extends controller
{
    private $pre = "visit_con";
    public function _initialize()
    {
        $this->visit_con();
        //查询网站顶部栏标题并加载
        $top_class_sql = "select class_id,class_title,class_Etitle from ns_class where class_fid = 0 and class_status = 1 order by class_oid desc";
        $top_class_list = Db::query($top_class_sql);
        foreach($top_class_list as $key => $val){
            $top_class_list[$key]['path_url'] = "http://".$_SERVER['HTTP_HOST'].Url::build('index/'.$val["class_Etitle"].'/index');;
        }
        $this->assign('top_class_list',$top_class_list);
        return $this->fetch('public/header');
    }
    private function visit_con()
    {
        $ip_info = json_decode(GetIp::get_ip(),true);
        $ip = $ip_info['data'];
        $key = $this->get_visit_con_key($ip);
        $redis_obj = new \Redis;
        $redis_obj->connect('127.0.0.1', 6379);
        if($redis_obj->exists($key)){
            $redis_obj->incr($key);
        }else{
            $redis_obj->setex($key,10,1);
        }
        $num = $redis_obj->get($key);
        if($num>20){
            die('点击过于频繁，清稍等再刷');
        }
    }
    private function get_visit_con_key($ip)
    {
        $key = $this->pre."-".$ip;
        return $key;
    }
}
