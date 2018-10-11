<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\Index;
class Content extends Common
{
    public function index()
    {
        $bloginfo_id = input('get.id');
        //被访问一次浏览量+1
        $this->clickNum($bloginfo_id);
        $bloginfo_content_list = $this->selContent($bloginfo_id);
        $this->assign('bloginfo_content_list',$bloginfo_content_list);
        $C_blogObj = new \app\index\controller\Blog;
        $C_blogObj->load_right();
        return $this->fetch();
    }
    public function selContent($id)
    {
        $sql = "SELECT nb.bloginfo_id as nbbloginfo_id,bloginfo_title,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,bloginfo_like,bloginfo_hate,bloginfo_click,blogcontent_ctt,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_blogcontent AS nbc ON nb.bloginfo_id = nbc.bloginfo_id
                LEFT JOIN ns_class AS nc ON nb.class_id = nc.class_id
                WHERE nb.bloginfo_id = ".$id;
        $res = Db::query($sql);
        return $res[0];
    }
    //浏览量统计
    public function clickNum($id)
    {
        $res = Db::table('ns_bloginfo')
        ->where('bloginfo_id',$id)
        ->setInc('bloginfo_click');
        if($res){
            return true;
        }else{
            return false;
        }
    }
}
