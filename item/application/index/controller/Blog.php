<?php
namespace app\index\controller;
use app\index\model\BlogModel;
use app\index\model\CategoryModel;
use app\index\model\LabelModel;
use app\tools\controller\Pagination;
class Blog extends Common
{   private $default_page = 15;
    private $M_blog;
    private $M_class;
    private $M_label;
    private $blog_class_fid = 2;
    public function __construct()
    {
        parent::__construct();
        $this->M_blog = new BlogModel;
        $this->M_class = new CategoryModel;
        $this->M_label = new LabelModel;
    }

    public function index()
    {
        //blog按照时间排序所有展示出来
        $list['blog_list'] = $this->get_blog_list();
        $list['class_list'] = $this->M_class->get_class_list_by_fid($this->blog_class_fid,'class_id,class_title');
        $list['label_list'] = $this->M_label->get_label_list('label_id,label_title');
        $list['right_list'] = $this->get_right_list();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function get_blog_list()
    {
        $page_obj = new Pagination(15);
        $page_id = input('page_id');
        $page_id = is_null($page_id)?1:$page_id;
        $limit = $page_obj->page_condition($page_id,$this->M_blog->get_blog_count());
        $search_key = input('search_key');
        $search_key = is_null($search_key)?"":$search_key;
        $blog_list = $this->M_blog->get_blog_list($search_key,$limit);
        $page_info = $page_obj->page($page_id,$this->M_blog->get_blog_count());
        $blog_list = array_map(function($v){
            $v['created_at'] = date('Y-m-d H:i:s',$v['bloginfo_createtime']);unset($v['bloginfo_createtime']);return $v;
        },$blog_list);
        $blog_list['blog_list'] = $blog_list;
        $blog_list['page_info'] = $page_info;
        return $blog_list;
    }
    public function index_class()
    {
        $list['blog_list'] = $this->get_index_class();
        $list['class_list'] = $this->M_class->get_class_list_by_fid($this->blog_class_fid,'class_id,class_title');
        $list['label_list'] = $this->M_label->get_label_list('label_id,label_title');
        $list['right_list'] = $this->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('index');
    }
    public function index_label()
    {
        $list['blog_list'] = $this->get_index_label();
        $list['class_list'] = $this->M_class->get_class_list_by_fid($this->blog_class_fid,'class_id,class_title');
        $list['label_list'] = $this->M_label->get_label_list('label_id,label_title');
        $list['right_list'] = $this->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('index');
    }
    public function get_index_class()
    {
        $class_id = input('class_id');
        $index_class_blog = $this->M_blog->get_blog_by_class($class_id);
        $index_class_blog = array_map(function($v){
            $v['created_at'] = date('Y-m-d H:i:s',$v['bloginfo_createtime']);unset($v['bloginfo_createtime']);return $v;
        },$index_class_blog);
        $blog_list['blog_list'] = $index_class_blog;
        $blog_list['page_info'] = "";
        return $blog_list;
    }
    public function get_index_label()
    {
        $label_id = input('label_id');
        $index_label_blog = $this->M_blog->get_blog_by_label($label_id);
        $index_label_blog = array_map(function($v){
            $v['created_at'] = date('Y-m-d H:i:s',$v['bloginfo_createtime']);unset($v['bloginfo_createtime']);return $v;
        },$index_label_blog);
        $blog_list['blog_list'] = $index_label_blog;
        $blog_list['page_info'] = "";
        return $blog_list;
    }
    public function index_content()
    {
        $list['content_info'] = $this->get_index_content();
        $list['right_list'] = $this->get_right_list();
        $this->assign('list',$list);
        return $this->fetch('content');
    }
    public function get_index_content()
    {
        $blog_id = input('blog_id');
        //记录点击量
        $res_click = $this->M_blog->add_scan_num($blog_id);
        $index_content_list = $this->M_blog->get_content_info($blog_id);
        $index_content_list['created_at'] = date("Y-m-d H:i:s",$index_content_list['bloginfo_createtime']);
        unset($index_content_list['bloginfo_createtime']);
        return $index_content_list;
    }
}