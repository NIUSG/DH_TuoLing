<?php
namespace app\command\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\tools\controller\Encrypt;
use think\Db;
use app\command\model\AbandonNsVisitorLogModel;
use think\cache\driver\File;
use think\cache\driver\Redis;
class Process extends Command
{
    protected function configure()
    {
        $this->setName('Process')->setDescription('多进程测试学习');
    }
    protected function execute(Input $input, Output $output)
    {
        $key = "test_res";
        $time1 = microtime(true);
        $bool = (new File)->has($key);
        if(!$bool){
            $res = (new AbandonNsVisitorLogModel)->getList();
            (new File)->set($key,$res);
        }else{
            $res = (new File)->get($key);
        }
        $time2 = microtime(true);
        var_dump($time2-$time1);
        var_dump(count($res));
        $time3 = microtime(true);

        $bool = (new Redis)->has($key);
        if(!$bool){
            $res = (new AbandonNsVisitorLogModel)->getList();
            (new Redis)->set($key,$res);
        }else{
            $res = (new Redis)->get($key);
        }
        $time4 = microtime(true);

        var_dump($time4-$time3);
        var_dump(count($res));











        // $pid = pcntl_fork();
        // if($pid == -1){
        //     die('error');
        // }elseif($pid){
        //     echo "this is father".microtime(true);
        // }else{
        //     echo "this is son".microtime(true);
        // }

    }
}