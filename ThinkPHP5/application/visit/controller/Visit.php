<?php
namespace app\visit\controller;
use think\Controller;
use think\Db;
use app\helper\controller\GetIp;
use app\request\controller\Request;
use think\cache\driver\File;
use think\cache\driver\Redis;
use think\cache\driver\Memcached;
use app\visit\model\VisitModel;
//use \app\admin\model\Common;
//分类管理控制器
class Visit extends controller
{
    public static $get_ip_url_taobao = 'http://ip.taobao.com/service/getIpInfo.php';
    public function main()
    {
        echo GetIp::get_ip();
    }
    public function data_cache_info()
    {
        $data['ip'] = json_decode(GetIp::get_ip(),true)['data'];
        $data['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $data['time'] = date('Y-m-d H:i:s');
        $data['microtime'] = microtime(true);
        return $data;
    }
    public function write_db()
    {
        $data_cache = $this->data_cache_info();
        $data['data'] = json_encode($data_cache);
        $data['key'] =  md5($data_cache['microtime']);
        $res = VisitModel::write_cache_db($data);
    }
    public function write_file()
    {
        $data_cache = $this->data_cache_info();
        $file_obj = new File();
        $time1 = microtime(true);
        for($i=0;$i<8000;$i++){
            $file_obj->set('data'.$i,$data_cache);
        }
        $time2 = microtime(true);
        echo $time2-$time1;

    }
    public function write_redis()
    {
        $data_cache = $this->data_cache_info();
        $redis_obj = new Redis();
        $time1 = microtime(true);
        for($i=0;$i<8000;$i++){
            $redis_obj->set('data'.$i,$data_cache);
        }
        $time2 = microtime(true);
        echo $time2-$time1;
    }
    public function write_Memcached()
    {
        $data_cache = $this->data_cache_info();
        $Memcached_obj = new Redis();
        $time1 = microtime(true);
        for($i=0;$i<8000;$i++){
            $Memcached_obj->set('data'.$i,$data_cache);
        }
        $time2 = microtime(true);
        echo $time2-$time1;
    }
}