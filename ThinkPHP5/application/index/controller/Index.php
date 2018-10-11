<?php
namespace app\index\controller;
use think\Db;
use app\visit\controller\Visit;
class Index extends Common
{
    public $class_fid_TechBlog = 2;
    public function index()
    {
        Visit::write_db();
        //首页推荐
        $home_blog_list = $this->blog_home();
        //博客点击排行
        $this->blog_click();
        //博客最新发布
        $this->blog_new();
        //常用链接
        $this->link_often();
        $this->assign('home_blog_list',$home_blog_list);
        return $this->fetch();
    }
    //首页推荐博客10篇//技术博客,浏览量从上往下
    public function blog_home()
    {
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_class AS nc ON nc.class_id = nb.class_id
                WHERE nb.bloginfo_status = 1 AND nb.class_id IN (SELECT class_id
                                                                 FROM ns_class
                                                                 WHERE class_status = 1 AND class_fid = {$this->class_fid_TechBlog})
                ORDER BY nb.bloginfo_click DESC
                LIMIT 10";
        $res = Db::query($sql);
        return $res;
    }
    //点击排行技术类博客前十条,并且加载
    public function blog_click()
    {
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_click
                FROM ns_bloginfo
                WHERE bloginfo_status = 1 and class_id IN (SELECT class_id
                                                           FROM ns_class
                                                           WHERE class_status = 1 AND class_fid = {$this->class_fid_TechBlog})
                ORDER BY bloginfo_click DESC
                LIMIT 10";
        $res = Db::query($sql);
        $this->assign('blog_click_list',$res);
    }
    //最新技术类发布前十条
    public function blog_new()
    {
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_click
                FROM ns_bloginfo
                WHERE bloginfo_status = 1 and class_id IN (SELECT class_id
                                                           FROM ns_class
                                                           WHERE class_status = 1 AND class_fid = {$this->class_fid_TechBlog})
                ORDER BY bloginfo_createtime DESC
                LIMIT 5";
        $res = Db::query($sql);
        $this->assign('blog_new_list',$res);
    }
    //常用导航
    public function link_often()
    {
        $sql = "SELECT link_id,link_title,link_url
                FROM ns_link
                WHERE link_status = 1
                ORDER BY link_clicknum DESC
                LIMIT 20";
        $res = Db::query($sql);
        $this->assign('link_often_list',$res);

    }
}
