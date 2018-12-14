<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Url;
use app\visit\controller\Write;
use app\helper\controller\GetIp;
use think\cache\driver\File;
use app\index\model\CommonModel;
use app\index\model\BlogModel;

class Common extends controller
{
    public $M_common;
    public $M_blog;
    public function __construct()
    {
        parent::__construct();
        $this->M_Common = new CommonModel();
        $this->M_blog = new BlogModel();
        $this->get_top_class_list();
    }
    public function get_top_class_list()
    {
        $top_class_list = $this->M_Common->top_class_list();
        $top_class_list = array_map(function($v){$v['url'] = "http://".$_SERVER['HTTP_HOST'].Url::build('index/'.$v["class_Etitle"].'/index');return $v;},$top_class_list);
        $this->assign("top_class_list",$top_class_list);
        return $this->fetch('public/header');
    }
    public function get_right_list()
    {
        $right_list['blog_latest_publish'] = $this->M_Common->get_blog_latest_publish();
        $right_list['blog_clicknum'] = $this->M_Common->get_blog_clicknum();
        $right_list['link_clicknum'] = $this->M_Common->get_link_clicknum();
        return $right_list;
    }
}
