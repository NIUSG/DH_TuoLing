<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\Index;
use app\visit\controller\Write;
class Content extends Common
{
    private $content_key = "content_key-";
    public function index()
    {
        Write::writeDB();
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
        $key = $this->content_key.$id;
        if($this->is_cache && $this->file_obj->has($key)){
            $res = $this->file_obj->get($key);
        }else{
            $sql = "SELECT nb.bloginfo_id as nbbloginfo_id,bloginfo_title,from_unixtime(bloginfo_createtime,'%Y-%m-%d') bloginfo_createtime,bloginfo_like,bloginfo_hate,bloginfo_click,blogcontent_ctt,class_title
                FROM ns_bloginfo AS nb
                LEFT JOIN ns_blogcontent AS nbc ON nb.bloginfo_id = nbc.bloginfo_id
                LEFT JOIN ns_class AS nc ON nb.class_id = nc.class_id
                WHERE nb.bloginfo_id = ".$id;
            $res = Db::query($sql);
            $res = $res[0];
            $this->file_obj->set($key,$res);
        }
        return $res;
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
