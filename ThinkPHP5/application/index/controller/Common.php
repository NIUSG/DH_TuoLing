<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Url;
use app\visit\controller\Write;
use app\helper\controller\GetIp;
use think\cache\driver\File;
class Common extends controller
{
    private $pre_avoid_refresh = "avoid_refresh-";
    private $top_class_key = "top_class_key";
    private $top_class_expire_time = "2592000";
    private $is_cache = true;
    public $file_obj;
    public function _initialize()
    {
        $this->file_obj = new File();
        $this->avoid_refresh_by_session();
        //查询网站顶部栏标题并加载
        if($this->is_cache && $this->file_obj->has($this->top_class_key)){
            $top_class_list = $this->file_obj->get($this->top_class_key);
        }else{
            $top_class_list = $this->get_top_class_list();
            $this->file_obj->set($this->top_class_key,$top_class_list,$this->top_class_expire_time);
        }
        $this->assign('top_class_list',$top_class_list);
        return $this->fetch('public/header');
    }
    private function get_top_class_list()
    {
        $top_class_sql = "select class_id,class_title,class_Etitle from ns_class where class_fid = 0 and class_status = 1 order by class_oid desc";
        $top_class_list = Db::query($top_class_sql);
        foreach($top_class_list as $key => $val){
            $top_class_list[$key]['path_url'] = "http://".$_SERVER['HTTP_HOST'].Url::build('index/'.$val["class_Etitle"].'/index');;
        }
        return $top_class_list;
    }
    private function avoid_refresh_by_session()
    {
        session_start();
        $cur_time = time();
        if(isset($_SESSION['last_time'])){
            $_SESSION['click_refresh'] += 1;
        }else{
            $_SESSION['click_refresh'] = 1;
            $_SESSION['last_time'] = time();
        }
        if($cur_time - $_SESSION['last_time'] <= 10){
            if($_SESSION['click_refresh'] >=30){
                die('点击过快,请慢点刷新');
            }
        }else{
            $_SESSION['last_time'] = $cur_time;
            $_SESSION['click_refresh'] = 0;
        }
        session_destroy();
    }
}
