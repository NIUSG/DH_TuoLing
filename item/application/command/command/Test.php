<?php
namespace app\command\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\tools\controller\Encrypt;
class Test extends Command
{
    protected function configure()
    {
        $this->setName('Test')->setDescription('测试脚本');
    }
    protected function execute(Input $input, Output $output)
    {
        var_dump("test");
    }
}