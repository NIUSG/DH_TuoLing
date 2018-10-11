<?php
namespace app\index\controller;
use think\Db;
use app\visit\controller\Visit;
class Aboutme extends Common
{
    public function index()
    {
        Visit::write_db();
        return view();
    }
}
