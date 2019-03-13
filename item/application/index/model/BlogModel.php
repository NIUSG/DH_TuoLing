<?php
namespace app\index\model;
use think\Model;
use think\Db;
class BlogModel extends CommonModel
{
    public function get_index_blog_list()
    {
        $sql = "SELECT
                        bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,bloginfo_createtime,class_title
                FROM
                        ns_bloginfo AS nb
                LEFT JOIN
                        ns_class AS nc on nb.class_id = nc.class_id
                WHERE
                        nb.bloginfo_status=1
                ORDER BY
                        nb.bloginfo_click DESC
                LIMIT 15";
        $res = Db::query($sql);
        return $res;
    }
    public function get_blog_clicknum()
    {
        $sql = "SELECT
                        bloginfo_id,bloginfo_title,bloginfo_click
                FROM
                        ns_bloginfo
                WHERE
                        bloginfo_status=1
                ORDER BY
                        bloginfo_click DESC
                LIMIT 10";
        $res = Db::query($sql);
        return $res;
    }
}



















































