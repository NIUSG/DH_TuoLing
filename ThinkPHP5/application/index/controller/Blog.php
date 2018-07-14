<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\Index;
use page\Pagination;
class Blog extends Common
{
    public $blog_class_fid = 2;
    public function index()
    {
        $class_id = $this->blog_class_fid;
        $search_key = input('get.search_key');
        $bloginfo = $this->sel_bloglist($class_id,$search_key);
        $blog_list = $bloginfo['blog'];
        $page = $bloginfo['page'];
        $this->assign('page',$page);
        $this->assign('blog_list',$blog_list);
        $son_class_list = $this->sel_SonClass($class_id);
        $this->assign('son_class_list',$son_class_list);
        $label_list = $this->sel_label();
        $this->assign('label_list',$label_list);
        /*
        $C_indexObj = new Index();
        $blog_click_list = $C_indexObj->blog_click();
        $blog_new_list = $C_indexObj->blog_new();
        $link_home_list = $C_indexObj->link_often();
        */
        $this->load_right();
        return $this->fetch('index');
    }
    //加载右侧公共部分
    public function load_right()
    {
        $C_indexObj = new Index();
        $blog_click_list = $C_indexObj->blog_click();
        $blog_new_list = $C_indexObj->blog_new();
        $link_home_list = $C_indexObj->link_often();
    }
    //查询该id下面的所有子类id
    public function sel_SonId($id)
    {
        $sql = "select class_id from ns_class where class_fid = ".$id." order by class_oid desc";
        $res = Db::query($sql);
        return $res;
    }
    //查询该分类下所有的博客列表
    public function sel_bloglist($id,$search_key)
    {
        $bloginfo_id_list = $this->sel_SonId($id);
        $tmp = array();
        foreach($bloginfo_id_list as $key=>$val){
            $tmp[] = $val['class_id'];
        }
        $bloginfo_id_str = implode(',',$tmp);
        //分页
        $count_sql = "SELECT COUNT(*) as count FROM ns_bloginfo WHERE bloginfo_title like '%{$search_key}%' AND class_id in (".$bloginfo_id_str.")";
        $count_arr = Db::query($count_sql);
        $count = $count_arr[0]['count'];
        $page_id = isset($_GET['page_id'])?$_GET['page_id']:1;
        $C_pagination = new pagination(10);
        $limit_cdtion = $C_pagination->page_condition($page_id,$count);
        $show_page = $C_pagination->page($page_id,$count);
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_class AS nc ON nb.class_id = nc.class_id
                WHERE bloginfo_title like '%{$search_key}%' AND nb.class_id in (".$bloginfo_id_str.") order by bloginfo_oid,bloginfo_id desc ".$limit_cdtion;
        $res = Db::query($sql);
        $bloglist['blog'] = $res;
        $bloglist['page'] = $show_page;
        return $bloglist;
    }
    //查询大分类下的子分类列表
    public function sel_SonClass($id)
    {
        $sql = "select class_id,class_title from ns_class where class_status = 1 and class_fid = {$id} order by class_oid desc";
        $res = Db::query($sql);
        return $res;
    }
    //查询标签
    public function sel_label()
    {
        $sql = "select label_id,label_title from ns_label where label_status = 1 order by label_oid desc";
        $res = Db::query($sql);
        return $res;
    }
    //查询某分类链接下的标签
    public function sel_class_label($id)
    {
        $sql = "SELECT label_id,label_title
                FROM ns_label
                WHERE label_id in (SELECT label_id
                                   FROM ns_class_label
                                   WHERE class_id = {$id})";
        $res = Db::query($sql);
        return $res;
    }
    //按照分类检索
    public function bloglist_class()
    {
        $class_id = input('get.id');
        $search_key = input('get.search_key');
        $this->assign('class_id',$class_id);
        $blog_list = $this->blog_SelClassId($class_id,$search_key);
        $blog_list_class = $blog_list['blog'];
        $page = $blog_list['page'];
        $this->assign('page',$page);
        $this->assign('blog_list_class',$blog_list_class);
        $son_class_list = $this->sel_CurClassList($class_id);
        $label_list = $this->sel_class_label($class_id);
        $this->load_right();
        $this->assign('label_list',$label_list);
        $this->assign('son_class_list',$son_class_list);
        return $this->fetch();

    }
    //按照分类id查询博客
    public function blog_SelClassId($id,$search_key)
    {

        //分页
        $count_sql = "SELECT COUNT(*) as count FROM ns_bloginfo WHERE bloginfo_title like '%{$search_key}%' AND class_id = ".$id;
        $count_arr = Db::query($count_sql);
        $count = $count_arr[0]['count'];
        $page_id = isset($_GET['page_id'])?$_GET['page_id']:1;
        $C_pagination = new pagination(10);
        $limit_cdtion = $C_pagination->page_condition($page_id,$count);
        $show_page = $C_pagination->page($page_id,$count);
        //查询
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_class AS nc ON nc.class_id = nb.class_id
                WHERE nb.class_id = $id AND bloginfo_title like '%{$search_key}%'
                LIMIT 10";
        $res = Db::query($sql);
        $bloglist['blog'] = $res;
        $bloglist['page'] = $show_page;
        return $bloglist;
    }
    //根据子类查询同类列表
    public function sel_CurClassList($id)
    {
        $sql = "select class_id,class_title from ns_class where class_fid = (select class_fid from ns_class where class_id = {$id})";
        $res = Db::query($sql);
        return $res;
    }
    //点击标签查询blog,博客总页面
    public function labelBlogList()
    {
        $label_id = input('get.id');
        $this->assign('label_id',$label_id);
        $search_key = input('get.search_key');
        $label_list = $this->label_Blog($label_id,$search_key);
        $label_Blog_list = $label_list['blog'];
        $page = $label_list['page'];
        $this->assign('page',$page);
        $this->assign('label_Blog_list',$label_Blog_list);
        $label_list = $this->sel_label();
        $this->assign('label_list',$label_list);
        $this->load_right();
        $son_class_list = $this->sel_SonClass($this->blog_class_fid);
        $this->assign('son_class_list',$son_class_list);
        return $this->fetch('label_blog_list');
    }
    public function label_Blog($id,$search_key)
    {
        //分页
        $count_sql = "SELECT COUNT(*) as count FROM ns_bloginfo WHERE bloginfo_id IN (SELECT bloginfo_id FROM ns_label_blog WHERE label_id = {$id}) AND bloginfo_status = 1 AND bloginfo_title like '%{$search_key}%'";
        $count_arr = Db::query($count_sql);
        $count = $count_arr[0]['count'];
        $page_id = isset($_GET['page_id'])?$_GET['page_id']:1;
        $C_pagination = new pagination(10);
        $limit_cdtion = $C_pagination->page_condition($page_id,$count);
        $show_page = $C_pagination->page($page_id,$count);
        //查询
        $sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_class AS nc ON nb.class_id = nc.class_id
                WHERE bloginfo_id IN (SELECT bloginfo_id
                                      FROM ns_label_blog
                                      WHERE label_id = {$id}) AND bloginfo_status = 1 AND bloginfo_title like '%{$search_key}%'
                ORDER BY bloginfo_click DESC";
        $res = Db::query($sql);
        $bloglist['blog'] = $res;
        $bloglist['page'] = $show_page;
        return $bloglist;
    }
}
