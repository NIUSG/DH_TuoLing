<?php
namespace app\index\controller;
use think\Controller;
use think\Url;

use app\tools\controller\Visit;
use app\index\model\CommonModel;
use app\index\model\BlogModel;
use app\index\model\CategoryModel;
use app\index\model\LabelModel;

class Common extends controller
{
    public $M_Common;
    public $M_Blog;
    public $M_Category;
    public $M_Label;
    public function __construct()
    {

        parent::__construct();
        Visit::listenVisit();
        $this->M_Common = new CommonModel();
        $this->M_Blog = new BlogModel();
        $this->M_Category = new CategoryModel();
        $this->M_Label = new LabelModel();
        $res = $this->get_top_class_list();
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