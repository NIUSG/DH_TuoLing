<?php
namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\LinkModel;
use app\index\model\CategoryModel;
class Link extends Common
{
    public $M_link;
    public $M_class;
    public $link_class = 1;
    public function __construct()
    {
        parent::__construct();
        $this->M_link = new LinkModel;
        $this->M_class = new CategoryModel;
    }
    public function index()
    {
        $list['class_link_info'] = $this->get_class_link_info();
        $list['recommend_link'] = $this->M_link->get_link_clicknum(35);
        $list['right_list'] = $this->get_right_list();
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function get_class_link_info()
    {
        $link_info = $this->M_link->get_link_info('link_id,link_title,link_url,class_id');
        $class_info = $this->M_class->get_class_list_by_fid($this->link_class,'class_id,class_title');
        $class_link_info = array_map( function($v) use ($link_info){
                $v['link_info'] = [];
                foreach($link_info  as $val){
                    if($v['class_id'] == $val['class_id']) $v['link_info'][] = $val;
                }
                return $v;
        } ,$class_info);
        return $class_link_info;
    }
}