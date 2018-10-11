<?php
namespace app\visit\model;
use think\Model;
use think\Db;
class VisitModel extends Model
{
    public static function write_cache_db($data)
    {
        $res = Db::table('ns_visit_cache')->insert($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}
