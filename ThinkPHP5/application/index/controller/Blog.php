<?php
namespace app\index\controller;
use app\index\model\CommonModel;
use app\index\model\BlogModel;
use think\Db;
use app\index\controller\Index;
use page\Pagination;
use app\visit\controller\Write;
class Blog extends Common
{
    public $blog_class_fid = 2;
    public $M_common;
    public $M_blog;
    public function __construct()
    {
        parent::__construct();
        $this->M_blog = new BlogModel();
        $this->M_common = new CommonModel();
    }
    //主页
    public function index()
    {
        if(isset($_GET['search_key'])){
            if(empty($_GET['search_key'])){
                $list['blog_list'] = $this->M_blog->get_blog_index_list();
            }else{
                $list['blog_list'] = $this->M_blog->get_blog_search_list($_GET['search_key']);
            }
        }else{
            $list['blog_list'] = $this->M_blog->get_blog_index_list();
        }
        $list['blog_class_list'] = $this->M_blog->get_blog_class_list();
        $list['label_list'] = $this->M_blog->get_label_list();
        $list['right_list'] = $this->M_common->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('index');
    }
    //按照分类搜索
    public function index_class()
    {
        $class_id = $_GET['class_id'];
        $list['blog_list'] = $this->M_blog->get_blog_index_class_list($class_id);
        $list['blog_class_list'] = $this->M_blog->get_blog_class_list();
        $list['label_list'] = $this->M_blog->get_class_label_list($class_id)['label_info'];
        $list['right_list'] = $this->M_common->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('index');
    }
    //按照标签搜索
    public function index_label()
    {
        $label_id = $_GET['label_id'];
        $list['blog_list'] = $this->M_blog->get_blog_index_label_list($label_id);
        $list['blog_class_list'] = $this->M_blog->get_label_class_list($label_id)['class_info'];
        $list['label_list'] = $this->M_blog->get_label_list();
        $list['right_list'] = $this->M_common->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('index');
    }
}
