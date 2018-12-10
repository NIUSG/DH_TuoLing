<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\controller\Common;
use think\cache\driver\File;
class CommonModel extends Model
{
    //是否需要缓存
    protected $is_cache;
    //缓存键,时间定义
    protected $class_info_key = "class_info_key";
    protected $class_info_key_time = 86400;

    protected $link_info_key = "link_info_key";
    protected $link_info_key_time = 86400;

    protected $blog_info_key = "blog_info_key";
    protected $blog_info_key_time = 86400;

    protected $label_info_key = "label_info_key";
    protected $label_info_key_time = 86400;

    protected $link_label_info = "link_label_info_key";
    protected $link_label_info_time = 86400;

    //对象
    protected $file_obj;
    public function __construct()
    {
        parent::__construct();
        $C_common = new Common();
        $this->is_cache = $C_common->is_cache;
        $this->file_obj = new File();
    }

    public function get_class_info()
    {
        $sql = "select * from ns_class where class_status=1 order by class_oid desc";
        $key = $this->class_info_key."-".base64_encode($sql);
        if($this->is_cache && $this->file_obj->has($key)){
            $res = $this->file_obj->get($key);
        }else{
            $res = Db::query($sql);
            $this->file_obj->set($key,$res,$this->class_info_key_time);
        }
        return $res;
    }

    public function get_link_info()
    {
        $sql = "select * from ns_link where link_status=1 order by link_clicknum desc";
        $key = $this->link_info_key."-".base64_encode($sql);
        if($this->is_cache && $this->file_obj->has($key)){
            $res = $this->file_obj->get($key);
        }else{
            $res = Db::query($sql);
            $this->file_obj->set($key,$res,$this->link_info_key_time);
        }
        return $res;
    }

    public function get_blog_info()
    {
        $sql = "select * from ns_bloginfo where bloginfo_status=1 order by bloginfo_click desc";
        $key = $this->blog_info_key."-".base64_encode($sql);
        if($this->is_cache && $this->file_obj->has($key)){
            $res = $this->file_obj->get($key);
        }else{
            $res = Db::query($sql);
            $this->file_obj->set($key,$res,$this->blog_info_key_time);
        }
        return $res;
    }

    public function get_label_info()
    {
        $sql = "select * from ns_label where label_status=1 order by label_oid desc";
        $key = $this->label_info_key."-".base64_encode($sql);
        if($this->is_cache && $this->file_obj->has($key)){
            $res = $this->file_obj->get($key);
        }else{
            $res = Db::query($sql);
            $this->file_obj->set($key,$res,$this->label_info_key_time);
        }
        return $res;
    }
    //最新发布
    public function get_blog_latest_publish($limit = 8)
    {
        $blog_info = $this->get_blog_info();
        array_multisort(array_column($blog_info,'bloginfo_createtime'),SORT_DESC,$blog_info);
        $blog_info_latest = array_slice($blog_info,0,$limit);
        return $blog_info_latest;
    }
    //点击排行
    public function get_blog_clicknum()
    {
        $blog_info = $this->get_blog_info();
        array_multisort(array_column($blog_info,'bloginfo_click'),SORT_DESC,$blog_info);
        $blog_info_clicknum = array_slice($blog_info,0,12);
        return $blog_info_clicknum;
    }
    //链接点击排行
    public function get_link_clicknum()
    {
        $link_info = $this->get_link_info();
        array_multisort(array_column($link_info,'link_clicknum'),SORT_DESC,$link_info);
        $link_info_clicknum = array_slice($link_info,0,20);
        return $link_info_clicknum;
    }
    public function get_right_list()
    {
        $right_list['blog_latest_publish'] = $this->get_blog_latest_publish();
        $right_list['blog_clicknum'] = $this->get_blog_clicknum();
        $right_list['link_clicknum'] = $this->get_link_clicknum();
        return $right_list;
    }
    public function get_class_label_info()
    {
        $class_info = array_column($this->get_class_info(),null,'class_id');
        $label_info = array_column($this->get_label_info(),null,'label_id');
        $sql = "select * from ns_class_label";
        $key = $this->link_label_info."-".base64_encode($sql);
        if($this->is_cache && $this->file_obj->has($key)){
            $class_label_info = $this->file_obj->get($key);
        }else{
            $class_label = Db::query($sql);
            $class_label_key = [];
            $label_class_key = [];
            foreach($class_label as $key => $val){
                $class_label_key[$val['class_id']][] = $val['label_id'];
                $label_class_key[$val['label_id']][] = $val['class_id'];
            }
            $class_label_list = [];
            foreach($class_label_key as $key => $val){
                $class_tmp = $class_info[$key];
                $class_tmp['label_info'] = [];
                foreach($val as $k=>$v){
                    $class_tmp['label_info'][$v] = $label_info[$v];
                }
                $class_label_list[$key] = $class_tmp;
            }
            $class_label_info['class_label_list'] = $class_label_list;
            $label_class_list = [];
            foreach($label_class_key as $key => $val){
                $label_tmp = $label_info[$key];
                $label_tmp['class_info'] = [];
                foreach($val as $k => $v){
                    $label_tmp['class_info'][$v] = $class_info[$v];
                }
                $label_class_list[$key] = $label_tmp;
            }
            $class_label_info['label_class_list'] = $label_class_list;
            $this->file_obj->set($key,$class_label_info,$this->link_label_info_time);
        }
        return $class_label_info;
    }
}