<?php
namespace app\console\service;

use app\tools\model\CacheKeyInfo;
use app\tools\controller\Redis;
use app\console\model\VisitIpLogModel;
use app\tools\controller\Request;
class VisitIpLogService
{
    public $get_ip_url_taobao = 'http://ip.taobao.com/service/getIpInfo.php';
    public $unit_exec_num = 50;
    public $M_Visit_ip_log;
    public function __construct()
    {
        $this->M_Visit_ip_log = new VisitIpLogModel();
    }
    public function exec_visitor_log()
    {

        $cache_data = $this->M_Visit_ip_log->get_visit_cache($this->unit_exec_num);
        if(empty($cache_data)) return;
        $cache_data = array_map(function($v){$v['data_info'] = json_decode($v['data'],true);return $v;},$cache_data);
        $cache_data = array_column($cache_data,null,'id');
        foreach($cache_data as $key => $val){
            $ip_info_list = $this->get_ip_info($val);
            if($ip_info_list['ip_info'] != null){
                $db_res = $this->M_Visit_ip_log->trans_visit_cache($ip_info_list);
                //入库成功则修改状态，入库失败则不管
                if($db_res){
                    $db_cache_res = $this->M_Visit_ip_log->modify_visit_cache_status($ip_info_list);
                }
            }
            sleep(2);
        }
    }
    public function get_ip_info($val)
    {
        $ip_info_url = $this->get_ip_url_taobao.'?ip='.$val['data_info']['ip'];
        $ip_info = json_decode(Request::curl_get($ip_info_url),true);
        $val['ip_info'] = ($ip_info['code'] == 0)?json_decode($ip_info['data'],true):null;
        return $val;
    }
}