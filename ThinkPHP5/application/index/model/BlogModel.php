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
        $blog_list = $this->get_blog_latest_publish(0);
        $class_info = array_column($this->get_class_info(),null,'class_id');
        $blog_list_format = [];
        foreach($blog_list as $key => $val){
            $val['class_title'] = $class_info[$val['class_id']]['class_title'];
            $blog_list_format[$key] = $val;
        }
        return $blog_list_format;

    }
    public function get_blog_index_class_list($class_id)
    {

        $blog_info_list = $this->get_blog_info();
        $blog_info_list_class = array_values(array_filter($blog_info_list,function($v) use ($class_id) {return ($class_id == $v['class_id']);}));
        $class_info = array_column($this->get_blog_class_list(),null,'class_id');
        $class_info_current = $class_info[$class_id];
        $blog_info_list_class = array_map(function($v) use ($class_info_current) {
            $v['class_title'] = $class_info_current['class_title'];
            return $v;
        },$blog_info_list_class);
        array_multisort(array_column($blog_info_list_class,'bloginfo_createtime'),SORT_DESC,$blog_info_list_class);
        return $blog_info_list_class;
    }
    public function get_blog_index_label_list($label_id)
    {
        $blog_info_list = array_column($this->get_blog_info(),null,"bloginfo_id");
        $label_info = array_column($this->get_label_info(),null,'label_id');
        $blog_label_info = $this->get_blog_label_info();
        $label_blog_key = $blog_label_info['label_blog'][$label_id];
        $blog_info_list_label = array_map(function($v) use ($blog_info_list) {$tmp = $blog_info_list[$v];return $tmp;},$label_blog_key);
        array_multisort(array_column($blog_info_list_label,'bloginfo_createtime'),SORT_DESC,$blog_info_list_label);
        $class_info = array_column($this->get_blog_class_list(),null,'class_id');
        $blog_info_list_label = array_map(function($v) use ($class_info) {
            $v['class_title'] = $class_info[$v['class_id']]['class_title'];
            return $v;
        },$blog_info_list_label);
        return $blog_info_list_label;


    }
    public function get_blog_search_list($search_key,$is_cache=true)
    {
        //判断搜索方式
        $time1 = microtime(true);
        if($is_cache){
            $blog_search_list = $this->get_blog_search_list_by_cache($search_key);
        }else{
            $blog_search_list = $this->get_blog_search_list_by_sql($search_key);
        }
        $time2 = microtime(true);
        //记录搜索日志
        $search_log = [
            'search_type' => "blog",
            'search_key' => $search_key,
            'is_cache' => $is_cache?1:0,
            'search_time'=>(string)($time2-$time1),
            'created_at' => date('Y-m-d H:i:s'),
            'res_count' => count($blog_search_list),
            'res_content' => implode(',',array_column($blog_search_list,'bloginfo_id')),
        ];
        $res = Db::name('search_log')->insert($search_log);
        return $blog_search_list;
    }
    public function get_blog_search_list_by_cache($search_key)
    {
        $class_info = array_column($this->get_class_info(),null,'class_id');
        $blog_info_list = $this->get_blog_info();
        $reg = "/[\s\S]*".$search_key."[\s\S]*/";
        $blog_info_search_list = array_filter($blog_info_list,function($v) use ($reg) {
            return preg_match($reg,$v['bloginfo_title']);
        });
        $blog_info_search_list = array_map(function($v) use ($class_info) {
            $v['class_title'] = $class_info[$v['class_id']]['class_title'];
            return $v;
        },$blog_info_search_list);
        //array_multisort(array_column($blog_info_search_list,'bloginfo_click'),SORT_DESC,$blog_info_search_list);
        return $blog_info_search_list;
    }
    public function get_blog_search_list_by_sql($search_key)
    {
        $sql = "select bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,bloginfo_createtime,FROM_UNIXTIME(bloginfo_createtime,'%Y-%m-%d %H:%i:%s') as time,class_title from ns_bloginfo as nb left join ns_class as nc on nb.class_id = nc.class_id where nb.bloginfo_title like '%".$search_key."%' and bloginfo_status=1 order by bloginfo_click desc";
        $blog_info_search_list = Db::query($sql);
        return $blog_info_search_list;
    }
    public function get_class_label_list($class_id)
    {
        return $this->get_class_label_info()['class_label_list'][$class_id];
    }
    public function get_label_class_list($label_id)
    {
        return $this->get_class_label_info()['label_class_list'][$label_id];
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