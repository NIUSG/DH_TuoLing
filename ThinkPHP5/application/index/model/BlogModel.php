<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\CommonModel;
class BlogModel extends CommonModel
{
    public function index_blog_list($limit = 15)
    {
        $blog_info_list = $this->get_blog_latest_publish($limit);
        return $blog_info_list;
    }
    public function blog_list()
    {
        list(,,$blog_list) = $this->get_blog_info();
        array_multisort(array_column($blog_list,'bloginfo_createtime'),SORT_DESC,$blog_list);
        list(,,$class_list) = $this->get_class_info();
        $blog_list = array_map(function($v)use($class_list){$v['class_title'] = $class_list[$v['class_id']]['class_title'];return $v;},$blog_list);
        return $blog_list;
    }
}