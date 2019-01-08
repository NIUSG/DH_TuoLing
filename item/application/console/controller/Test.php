<?php
namespace app\console\controller;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\console\service\TestService;
use app\tools\model\CacheKeyInfo;
use app\tools\controller\Redis;
use app\console\service\VisitService;
use app\tools\controller\Log;
class Test extends Command
{
    protected function configure()
    {
        $this->setName('Test')->setDescription('console测试demo');
    }

    protected function execute(Input $input, Output $output)
    {
        $log_obj = new Log();
        $log_obj->init('test');
        $log_obj->info('nihao');
    }
}