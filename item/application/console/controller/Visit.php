<?php
namespace app\console\controller;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Log;

use app\tools\model\CacheKeyInfo;
use app\tools\controller\Redis;
use app\console\service\VisitService;
class Visit extends Command
{
    protected function configure()
    {
        $this->setName('visit')->setDescription('visit,console listen redis and to database ');
    }

    protected function execute(Input $input, Output $output)
    {
        //上锁
        $redis = Redis::get_instance();
        if(!is_null($redis->Redis_obj)){
            $cache_info = CacheKeyInfo::get_cache_key('lock_console_visit');
        }else{
            throw new \BadFunctionCallException('不支持redis，console代码无法上锁');
        }
        if($redis->Redis_obj->get($cache_info['key'])){
            throw new \BadFunctionCallException('visit已经上锁，redis键为lock_console_visit');
        }
        $redis->Redis_obj->setnx($cache_info['key'],1) && $redis->Redis_obj->expire($cache_info['key'],$cache_info['time']);
        //定义php执行时间
        ini_set('max_execution_time', 600);
        //执行核心逻辑
        $visit_obj = new VisitService();
        $res_link = $visit_obj->link();
        $res_blog = $visit_obj->blog();
        $res_web = $visit_obj->web();
        $res_web = $visit_obj->search_log();
    }
}