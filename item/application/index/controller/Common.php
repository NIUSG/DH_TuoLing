<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\CategoryModel;
use app\index\model\BlogModel;
use app\index\model\LinkModel;
use think\Url;
class Common extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->get_top_class_list();
    }
    public function get_top_class_list()
    {
        $M_category = new CategoryModel;
        $top_class_list = $M_category->get_class_list_by_fid(0,'class_title,class_Etitle');
        $top_class_list = array_map(function($v){
            $v['url'] = $_SERVER['HTTP_HOST'].Url::build("".$v['class_Etitle']."/index");return $v;
        },$top_class_list);
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

}