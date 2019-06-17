<?php
namespace app\command\model;
use think\Db;
use think\Model;

class AbandonNsVisitorLogModel extends Model
{
    protected $table = 'abandon_ns_visitor_log';

    public function getList($field="*",$where=[],$other=[])
    {
        $res = $this
        ->field($field)
        ->where($where)
        ->select();
        return empty($res) ? [] : $res->toArray();
    }

}