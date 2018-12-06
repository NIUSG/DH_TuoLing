<?php
namespace app\index\model;
use think\Model;
use think\Db;
use think\cache\driver\File;
use app\index\model\TotalModel;
use app\index\model\CommonModel;
class BlogModel extends TotalModel
{
    private $common_model_obj;
    private $all_blog_info_key = "all_blog_info_key";
    private $all_blog_info_key_time = 86400;
    public function __construct()
    {
        parent::__construct();
        $this->common_model_obj = new CommonModel();
    }
    public function get_all_blog_info()
    {
        if($this->common_index_obj->is_cache && $this->file_cache_obj->has($this->all_blog_info_key)){
            $res = $this->file_cache_obj->get($this->all_blog_info_key);
        }else{
            $sql = "select * from ns_bloginfo where bloginfo_status=1";
            $res = Db::query($sql);
            $this->file_cache_obj->set($this->all_blog_info_key,$res,$this->all_blog_info_key_time);
        }
        return $res;
    }
    public function get_blog_list()
    {
        $blog_info = $this->get_all_blog_info();
        //$class_info = $this->common_model_obj->get_class_info();
        //var_dump($class_info);
    }
}