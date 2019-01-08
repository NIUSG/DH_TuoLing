<?php
namespace app\tools\controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    public $log_path_monogo = LOG_PATH.'monolog/';
    public $log_obj;
    public function init($log_name)
    {
        $this->log_obj = new Logger($log_name);
        $this->log_obj->pushHandler(new StreamHandler($this->log_path_monogo.'/'.$log_name.'.log', Logger::WARNING));
    }
    public function warning($str)
    {
        $this->log_obj->warning($str);
    }
    public function error($str)
    {
        $this->log_obj->error($str);
    }
    public function info($str)
    {
        $this->log_obj->info($str);
    }
}