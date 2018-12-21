<?php
namespace app\tools\controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    public $log_path_monogo = LOG_PATH.'monolog/';
    public function init()
    {
        $log = new Logger('abc');
        var_dump($this->log_path_monogo);
        $log->pushHandler(new StreamHandler($this->log_path_monogo.'/abc.log', Logger::WARNING));
        // add records to the log
        $log->warning('Foo');
        $log->error('Bar');
        $log->info('abc');
    }
}