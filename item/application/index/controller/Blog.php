<?php
namespace app\index\controller;

class Blog extends Common
{
    public function index()
    {
        $list = [];
        $list['blog_list'] = $this->M_Blog->blog_list();
        $list['right_list'] = $this->get_right_list();
        list(,,$list['label_list']) = $this->M_Common->get_label_info();
        $list['class_list'] = $this->M_Category->class_list(2);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function index_class()
    {
        $list = [];
        $class_id = input('get.class_id');
        $list['blog_list'] = $this->M_Blog->blog_list_index_class($class_id);
        $list['class_list'] = $this->M_Category->class_list(2);
        $list['label_list'] = $this->M_Label->get_label_list_by_class($class_id);
        $list['right_list'] = $this->get_right_list();
        $this->assign("list",$list);
        return $this->fetch('index');
    }
    public function index_label()
    {
        $list = [];
        $label_id = input('get.label_id');
        $list['blog_list'] = $this->M_Blog->blog_list_index_label($label_id);
        $list['class_list'] = $this->M_Category->get_class_list_by_label($label_id);
        list(,,$list['label_list']) = $this->M_Common->get_label_info();
        $list['right_list'] = $this->get_right_list();
        $this->assign("list",$list);
        return $this->fetch('index');
    }
    public function index_content()
    {
        $list = [];
        $blog_id = input('get.blog_id');
        $this->M_Blog->record_visit_blog($blog_id);
        list(,,$list['content_info']) = $this->M_Blog->get_content_info($blog_id);
        $list['right_list'] = $this->get_right_list();
        $this->assign("list",$list);
        return $this->fetch('content');
    }
}