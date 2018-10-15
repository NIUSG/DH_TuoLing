<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\Index;
use app\visit\controller\Write;
class Link extends Common
{
    public $class_id = 1;
    public function index()
    {
        Write::writeDB();
        $recommend_list = $this->sel_recommend();
        $this->assign('recommend_list',$recommend_list);
        $link_class_list = $this->selLinkClass($this->class_id);
        $this->assign('link_class_list',$link_class_list);
        $this->right_load();
        return $this->fetch();
    }
    //查询推荐导航
    public function sel_recommend()
    {
        $sql = "select link_id,link_title,link_url from ns_link where link_status = 1 order by link_clicknum desc limit 30";
        $res = Db::query($sql);
        return $res;
    }
    //查询导航的全部分类
    public function selClass($id)
    {
        $sql = "select class_id,class_title from ns_class where class_fid = {$id} and class_status = 1 order by class_oid desc";
        $res = Db::query($sql);
        return $res;
    }
    //查询导航分类下的导航
    public function selLinkClass($id)
    {
        $link_class = $this->selClass($id);
        foreach($link_class as $key => $val){
            $sql = "select link_id,link_title,link_url from ns_link where link_status = 1 and class_id = {$val['class_id']} order by link_clicknum desc";
            $link_class[$key]['link'] = Db::query($sql);
        }
        return $link_class;
    }
    //加载右边栏目
    public function right_load()
    {
        //右边栏目
        $C_Index = new Index;
        //博客点击排行
        $C_Index->blog_click();
        //博客最新发布
        $C_Index->blog_new();
        //常用链接
        $C_Index->link_often();
    }
    public function click_num()
    {
        Write::writeDB();
        if($_GET['url']){
            $url = input('get.url');
            $id = input('get.id');
            $res = Db::table('ns_link')
            ->where('link_id',$id)
            ->setInc('link_clicknum');
            if($res){
                $this->redirect($url);
            }else{
                echo "数据统计失败";
            }
            return ;
        }
        return "url为空";
    }
}
