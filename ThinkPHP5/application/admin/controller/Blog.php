<?php
namespace app\admin\controller;
use app\admin\model;
use think\Controller;
use think\Db;
use page\Pagination;
//use \app\admin\model\Common;
//分类管理控制器
class Blog extends Common
{
    public function index()
    {
        if($_POST){
            $search_keywords = $_REQUEST['search_keywords'];
        }else{
            $search_keywords = "";
        }
        if($_GET){
            $page_id = $_GET['page_id'];
        }else{
            $page_id = 1;
        }
        //$search_keywords = ($_REQUEST['search_keywords'])?$_REQUEST['search_keywords']:"";
        //查询博客详情表,展示博客信息
        $pageObj = new pagination(10);
        $blog_total_sql = "SELECT COUNT(1) as total FROM ns_bloginfo WHERE bloginfo_title like '%".$search_keywords."%'";
        $total = current(current(Db::query($blog_total_sql)));
        $page_condition = $pageObj->page_condition($page_id,$total);
        $page_res = $pageObj->page($page_id,$total);
        $blog_sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_status,
                            FROM_UNIXTIME(bloginfo_createtime,'%Y-%m-%d %H:%i:%s') AS bloginfo_createtime,class_title
                     FROM ns_bloginfo AS nb
                     LEFT JOIN ns_class nc
                     ON nb.class_id = nc.class_id
                     WHERE bloginfo_title like '%".$search_keywords."%' AND bloginfo_status = 1
                     ORDER BY bloginfo_oid,bloginfo_id DESC ".$page_condition;
        $blog_list = Db::query($blog_sql);
        $this->assign('page_res',$page_res);
        $this->assign('blog_list',$blog_list);
        return view();
    }
    public function add()
    {
        if(request()->isPost()){
            //接受数据
            $data = input('post.');
            $data['bloginfo_createtime'] = time();
            $data['bloginfo_updatetime'] = time();
            //区别上传的图片和默认的图片
            if($_FILES['bloginfo_img']['error'] == 0){
                $data['bloginfo_img'] = $this->Uploads('bloginfo_img','BlogsImg');
            }else{
                $data['bloginfo_img'] = 'InitializeImg/initialize.jpg';
            }
            //分离需要上传其他表的数据
            if(!empty($data['label_id'])) $data_label_blog = $data['label_id'];
            if(!empty($data['bloginfo_link'][0])) $data_blog_link = array_filter($data['bloginfo_link']);
            $data_blogcontent_ctt['blogcontent_ctt'] = $data['blogcontent_ctt'];
            unset($data['bloginfo_link']);
            unset($data['label_id']);
            unset($data['blogcontent_ctt']);
            //如果没有填写描述,则截取正文作为描述
            trim(($data['bloginfo_describe'])) || str_replace(" ","",$data['bloginfo_describe'] = mb_substr(strip_tags($data_blogcontent_ctt['blogcontent_ctt']),0,130)."...");
            //上传数据整理完毕,上传数据
            //由于三表操作,开启事务
            Db::startTrans();
            //上传bloginfo,获得id
            $res_bloginfo = Db::name('bloginfo')->insertGetId($data);
            if($res_bloginfo){
                //处理需要上传的内容
                $data_blogcontent_ctt['bloginfo_id'] = $res_bloginfo;
                $res_ctt = Db::name('blogcontent')->insert($data_blogcontent_ctt);
                //处理需要上传的标签id数组
                if(isset($data_label_blog)){
                    $data_label_blog_ins = array();
                    foreach($data_label_blog as $key => $val){
                        $data_label_blog_ins[$key]['bloginfo_id'] = $res_bloginfo;
                        $data_label_blog_ins[$key]['label_id'] = $val;
                    }
                    $res_label_blog = Db::name('label_blog')->insertAll($data_label_blog_ins);
                }
                if(isset($data_blog_link)){
                    $data_link_blog_ins = array();
                    foreach($data_blog_link as $key => $val){
                        $data_link_blog_ins[$key]['bloginfo_id'] = $res_bloginfo;
                        $data_link_blog_ins[$key]['bloglink_url'] = $val;
                    }
                    dump($data_link_blog_ins);
                    $res_link_blog = Db::name('blog_link')->insertAll($data_link_blog_ins);
                }
            }
            $res_label_blog = isset($res_label_blog)?$res_label_blog:true;
            $res_link_blog = isset($res_link_blog)?$res_link_blog:true;
            if( $res_bloginfo>0 && $res_ctt && $res_label_blog && $res_link_blog ){
                Db::commit();
                $this->success('文章添加成功',url('index'));
            }else{
                Db::rollback();
                $this->errors('文章添加失败');
            }
            return;
        }
        //查询分类,供博客选择
        $class_sql = "select class_id,class_fid,class_title from ns_class where class_status = 1 order by class_oid desc";
        $class_list = Db::query($class_sql);
        $class_list = $this->MCommon->recursionNoTree($class_list,'class_id','class_fid',0,0);
        $class_list = $this->MCommon->addStrForArr($class_list);
        $this->assign("class_list",$class_list);
        //查询标签,供博客选择,多对多
        $label_sql = "select label_id,label_title from ns_label where label_status = 1 order by label_oid,label_id desc";
        $label_list = Db::query($label_sql);
        $this->assign("label_list",$label_list);
        return view();
    }

}
