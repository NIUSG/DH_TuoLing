<?php
namespace app\console\controller;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\console\model\DemoModel;
use app\console\service\DemoService;
class Demo extends Command
{
    protected function configure()
    {
        $this->setName('Demo')->setDescription('平常玩的一些命令行和数据插入');
    }

    protected function execute(Input $input, Output $output)
    {
        var_dump('DEMO');
    }
}