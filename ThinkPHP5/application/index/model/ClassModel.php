<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\CommonModel;
class ClassModel extends CommonModel
{
    public $blog_class_id = 2;
    public $link_class_id = 1;
    public function class_list($class_fid = -1){
        list(,,$class_list) = $this->get_class_info();
        if($class_fid == -1) return $class_list;
        $class_list = array_filter($class_list,function($v)use($class_fid){
            return ($v['class_fid'] == $class_fid)?true:false;
        });
        return $class_list;
    }
}