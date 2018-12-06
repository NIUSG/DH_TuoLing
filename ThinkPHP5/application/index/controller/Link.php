<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\Index;
use app\visit\controller\Write;
class Link extends Common
{
    public $class_id = 1;
    private $link_info_key = "link_info_key";
    private $link_info_key_time = 86400;
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
    public function get_link_info()
    {
        if($this->is_cache && $this->file_obj->has($this->link_info_key)){
            $res = $this->file_obj->get($this->link_info_key);
        }else{
            $sql = "select
                    nc.class_id as class_as_id,class_title,nl.link_id,nl.link_title,nl.link_url,nc.class_oid,nl.link_clicknum
                from
                    ns_class as nc
                left join
                    ns_link as nl
                on
                    nc.class_id = nl.class_id
                where
                    nc.class_fid=1 and nc.class_status = 1";
            $res = Db::query($sql);
            $res = array_map(function($v){$v['class_id'] = $v['class_as_id'];unset($v['class_as_id']);return $v;},$res);
            $this->file_obj->set($this->link_info_key,$res,$this->link_info_key_time);
        }
        return $res;
    }
    //查询推荐导航
    public function sel_recommend()
    {
        $link_info = $this->get_link_info();
        $link_info_click_arr = array_column($link_info,'link_clicknum');
        array_multisort($link_info_click_arr,SORT_DESC,$link_info);
        $link_info = array_slice($link_info,0,30);
        return $link_info;
    }
    /*//查询导航的全部分类
    public function selClass($id)
    {
        $sql = "select class_id,class_title from ns_class where class_fid = {$id} and class_status = 1 order by class_oid desc";
        $res = Db::query($sql);
        return $res;
    }*/
    //查询导航分类下的导航
    public function selLinkClass($id)
    {
        $link_info = $this->get_link_info();
        $link_info_format = [];
        foreach($link_info as $key => $val){
            $link_info_format[$val['class_id']]['class_id'] = $val['class_id'];
            $link_info_format[$val['class_id']]['class_title'] = $val['class_title'];
            $link_info_format[$val['class_id']]['class_oid'] = $val['class_oid'];
            $link_info_format[$val['class_id']]['link'][] = $val;
        }
        array_multisort(array_column($link_info_format,'class_oid'),SORT_DESC,$link_info_format);
        return $link_info_format;
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
