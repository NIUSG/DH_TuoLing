<?php
namespace app\console\model;
use think\Db;
use think\Model;

class VisitModel extends Model
{
    public function add_link_clicknum($link_id)
    {
        $sql = "update ns_link set link_clicknum = link_clicknum+1 where link_id = ".$link_id;
        $res = Db::execute($sql);
        return $res;
    }
     public function add_blog_clicknum($blog_id)
    {
        $sql = "update ns_bloginfo set bloginfo_click = bloginfo_click+1 where bloginfo_id = ".$blog_id;
        $res = Db::execute($sql);
        return $res;
    }
    public function add_ns_visit_cache($key,$visit_info)
    {
        $visit_info = json_encode($visit_info);
        $sql = "insert into ns_visit_cache (`k`,`data`) value ('".$key."','".$visit_info."')";
        $res = Db::execute($sql);
        return $res;
    }
    public function add_search_log($val)
    {
        $res = Db::table('ns_search_log')->insertGetId($val);
        return $res;
    }
}