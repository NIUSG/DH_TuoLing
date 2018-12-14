<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\CommonModel;
class BlogModel extends CommonModel
{
    public function index_blog_list($limit = 15)
    {
        $blog_info_list = $this->get_blog_latest_publish($limit);
        var_dump($blog_info_list);
    }
}