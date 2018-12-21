<?php
namespace app\console\model;
use think\Db;
use think\Model;

class VisitIpLogModel extends Model
{
    public function get_visit_cache($limit)
    {
        $sql = "select * from ns_visit_cache where status = 'n' limit ".$limit;
        $res = Db::query($sql);
        return $res;
    }
    public function trans_visit_cache($ip_info)
    {
        $check_res = $this->check_ip_data($ip_info);
        if(!$check_res) return false;
        $cache_log_data['vst_ip'] = $ip_info['data_info']['ip'];
        $cache_log_data['vst_url'] = $ip_info['data_info']['url'];
        $cache_log_data['ip_country'] = $ip_info['ip_info']['data']['country'];
        $cache_log_data['ip_province'] = $ip_info['ip_info']['data']['region'];
        $cache_log_data['ip_city'] = $ip_info['ip_info']['data']['city'];
        $cache_log_data['vst_at'] = 0;
        $cache_log_data['vst_date'] = $ip_info['data_info']['time'];
        $res = Db::table('ns_visitor_log')->insertGetId($cache_log_data);
        return $res?true:false;
    }
    public function check_ip_data($ip_info)
    {
        if(!isset($ip_info['ip_info'])) return false;
        if( (!isset($ip_info['ip_info']['code'])) || ($ip_info['ip_info']['code']!=0) ) return false;
        if(!isset($ip_info['data'])) return false;
        $ip_info_need_key = ['ip','country','region','city'];
        $ip_info_key = array_keys($ip_info['ip_info']['data']);
        foreach($ip_info_need_key as $val){
            $res = in_array($val,$ip_info_key);
            if(!$res){
                return false;
            }
        }
        return true;
    }
    public function modify_visit_cache_status($ip_info)
    {
        $id = $ip_info['id'];
        $sql = "update ns_visit_cache set status = 'y' where id=".$id;
        var_dump($sql);
        $res = Db::execute($sql);
        var_dump($res);
    }
}