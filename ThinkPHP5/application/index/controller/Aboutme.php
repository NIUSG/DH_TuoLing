<?php
namespace app\index\controller;
use think\Db;
use app\helper\controller\Visit;
class Aboutme extends Common
{
    public function index()
    {
         Visit::write_visit_log();
        return view();
    }
}
