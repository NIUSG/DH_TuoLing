<?php
namespace app\index\model;
use think\Model;
use think\Db;
use think\cache\driver\File;
use app\index\controller\Common;
use app\index\model\BlogModel;
use app\index\model\TotalModel;
class CommonModel extends TotalModel
{
    public $blog_class_fid = 2;

    private $blog_model_obj;


    private $class_info_key = "class_info_key";
    private $class_info_key_time = 86400;

    private $label_info_key = "label_info_key";
    private $label_info_key_time = 86400;

    private $link_info_key = "link_info_key";
    private $link_info_key_time = 86400;
    public function __construct()
    {
        parent::__construct();
        $this->blog_model_obj = new BlogModel();
    }
    public function get_blog_class()
    {
        $class_info = $this->get_class_info();
        $blog_class_fid = $this->blog_class_fid;
        $blog_class = array_values(array_filter($class_info,function($v) use ($blog_class_fid) {if($v['class_fid'] == $this->blog_class_fid){return true;}}));
        return $blog_class;

    }
    public function get_label_info()
    {
        if( $this->common_index_obj->is_cache && $this->file_cache_obj->has($this->label_info_key) ){
            $res = $this->file_cache_obj->get($this->label_info_key);
        }else{
            $sql = "select * from ns_label where label_status = 1 order by label_oid,label_id desc";
            $res = Db::query($sql);
            $this->file_cache_obj->set($this->label_info_key,$res,$this->label_info_key_time);
        }
        return $res;
    }
    public function get_class_info()
    {
        if( $this->common_index_obj->is_cache && $this->file_cache_obj->has($this->class_info_key)){
            $res = $this->file_cache_obj->get($this->class_info_key);
        }else{
            $sql = "select * from ns_class where class_status = 1";
            $res = Db::query($sql);
            array_multisort(array_column($res,'class_oid'),SORT_DESC,$res);
            $this->file_cache_obj->set($this->class_info_key,$res,$this->class_info_key_time);
        }
        return $res;
    }
    public function get_link_info()
    {
        if( $this->common_index_obj->is_cache && $this->file_cache_obj->has($this->link_info_key)){
            $res = $this->file_cache_obj->get($this->link_info_key);
        }else{
            $sql = "select * from ns_link where link_status = 1 order by link_clicknum desc";
            $res = Db::query($sql);
            $this->file_cache_obj->set($this->link_info_key,$res,$this->link_info_key_time);
        }
        return $res;
    }
    public function get_blog_latest()
    {
        $all_blog_info = $this->blog_model_obj->get_all_blog_info();
        array_multisort(array_column($all_blog_info,"bloginfo_createtime"),SORT_DESC,$all_blog_info);
        $blog_latest = array_slice($all_blog_info,0,8);
        return $blog_latest;
    }
    public function get_blog_click()
    {
        $all_blog_info = $this->blog_model_obj->get_all_blog_info();
        array_multisort(array_column($all_blog_info,"bloginfo_click"),SORT_DESC,$all_blog_info);
        $blog_click = array_slice($all_blog_info,0,12);
        return $blog_click;
    }
    public function get_link_click()
    {
        $link_info = $this->get_link_info();
        $link_click = array_slice($link_info,0,12);
        var_dump($link_click);
    }
}