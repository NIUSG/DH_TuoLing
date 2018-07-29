<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Url;
use app\helper\controller\Visit;
class Common extends controller
{
    public function _initialize()
    {
        Visit::write_visit_log();
        //查询网站顶部栏标题并加载
        $top_class_sql = "select class_id,class_title,class_Etitle from ns_class where class_fid = 0 and class_status = 1 order by class_oid desc";
        $top_class_list = Db::query($top_class_sql);
        foreach($top_class_list as $key => $val){
            $top_class_list[$key]['path_url'] = "http://".$_SERVER['HTTP_HOST'].Url::build('index/'.$val["class_Etitle"].'/index');;
        }
        $this->assign('top_class_list',$top_class_list);
        return $this->fetch('public/header');
    }
}
