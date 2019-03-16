<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\console\model\VisitModel;
class Visit extends Command
{
    protected function configure()
    {
        $this->setName('Visit')->setDescription('访问日志，缓存解析');
    }

    public function execute(Input $input, Output $output)
    {
        var_dump('abc');
    }
}
