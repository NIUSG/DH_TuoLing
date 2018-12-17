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
    public function index()
    {
        $list = [];
        $list['blog_list'] = $this->M_Blog->blog_list();
        $list['right_list'] = $this->get_right_list();
        list(,,$list['label_list']) = $this->M_Common->get_label_info();
        $list['class_list'] = $this->M_Class->class_list(2);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function blog_class()
    {

    }
    public function blog_label()
    {

    }
}
