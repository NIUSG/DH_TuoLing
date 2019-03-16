<?php
namespace app\command\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\command\model\VisitModel;
use app\tools\controller\Curl;
class Visit extends Command
{
    private $taobao_ip = 'http://ip.taobao.com/service/getIpInfo.php?ip=';
    private $M_visit;
    private $T_curl;
    public function __construct()
    {
        parent::__construct();
        $this->M_visit = new VisitModel;
    }
    protected function configure()
    {
        $this->setName('Visit')->setDescription('访问日志，缓存翻译脚本');
    }

    protected function execute(Input $input, Output $output)
    {
        //查询缓存数据
        $cache_list = $this->format_visit_log_cache();
        $visit_info = $this->trans_ip($cache_list);
        $insert_data = $this->format_visit_info($visit_info);
        //入库
        $res = $this->insert_log($insert_data);
    }
    private function format_visit_log_cache()
    {
        $cache_list = $this->M_visit->get_visit_log_cache();
        $cache_list = array_map(function($v){
            $tmp = json_decode($v['data'],true);
            unset($v['data']);
            $v = array_merge($v,$tmp);
            return $v;
        },$cache_list);
        return $cache_list;
    }
    private function trans_ip($cache_list)
    {
        $cache_list = array_map(function($v){
            $v['ip_info'] = $this->format_ip($v['ip']);
            return $v;
        },$cache_list);
        return $cache_list;
    }
    private function format_ip($ip)
    {
        if( !isset($ip) || empty($ip) ) return [];
        $url = $this->taobao_ip.$ip;
        $res = json_decode(Curl::curl_get($url),true);
        if( isset($res['code']) && $res['code'] == 0 )return $res['data'];
        return [];
    }
    private function format_visit_info($visit_info)
    {
        $insert_data = [];
        foreach($visit_info as $val){
            if(!empty($val['ip_info'])){
                $insert_data[] = $val;
            }
        }
        return $insert_data;
    }
    private function insert_log($insert_data)
    {
        foreach($insert_data as $val){
            $res = $this->M_visit->insert_log($val);
            var_dump($res);
        }
    }
}