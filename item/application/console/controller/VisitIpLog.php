<?php
namespace app\console\controller;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Log;

use app\console\service\VisitIpLogService;
use app\tools\model\CacheKeyInfo;
use app\tools\controller\Redis;
class VisitIpLog extends Command
{
    protected function configure()
    {
        $this->setName('VisitIpLog')->setDescription('visit ip console listen cache table to log table ');
    }

    protected function execute(Input $input, Output $output)
    {
        //上锁
        $this->lock();
        //执行
        $S_Visit_ip_obj = new VisitIpLogService();
        $S_Visit_ip_obj->exec_visitor_log();

    }
    protected function lock()
    {
        //上锁
        $redis = Redis::get_instance();
        if(!is_null($redis->Redis_obj)){
            $cache_info = CacheKeyInfo::get_cache_key('lock_console_visit_log');
        }else{
            throw new \BadFunctionCallException('不支持redis，console代码无法上锁');
        }
        if($redis->Redis_obj->get($cache_info['key'])){
            throw new \BadFunctionCallException('visit已经上锁，redis键为lock_console_visit_log_key');
        }
        $redis->Redis_obj->setnx($cache_info['key'],1) && $redis->Redis_obj->expire($cache_info['key'],$cache_info['time']);
    }
}