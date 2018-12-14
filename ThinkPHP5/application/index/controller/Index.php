<?php
namespace app\index\controller;
use think\Db;
use app\visit\controller\Write;
use app\traits\logger\LoggerTrits;
class Index extends Common
{
    public function index()
    {
        $index_blog_list = $this->M_blog->index_blog_list(15);
    }
}
