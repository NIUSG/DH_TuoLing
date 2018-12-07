<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\CommonModel;
class BlogModel extends CommonModel
{
    private $blog_class_id=2;
    public function get_blog_index_list()
    {
        $blog_list = $this->get_blog_latest_publish(15);
        $class_info = array_column($this->get_class_info(),null,'class_id');
        $blog_list_format = [];
        foreach($blog_list as $key => $val){
            $val['time'] = date('Y-m-d H:i:s',$val['bloginfo_createtime']);
            $val['class_title'] = $class_info[$val['class_id']]['class_title'];
            $blog_list_format[$key] = $val;
        }
        return $blog_list_format;

    }
    public function get_blog_class_list()
    {
        $class_info = $this->get_class_info();
        $blog_class_info = array_values(array_filter($class_info,function($v){return ($v['class_fid'] == 2);}));
        array_multisort(array_column($blog_class_info,'class_oid'),SORT_DESC,$blog_class_info);
        return $blog_class_info;
    }
    public function get_label_list()
    {
        $label_info = $this->get_label_info();
        return $label_info;
    }
}