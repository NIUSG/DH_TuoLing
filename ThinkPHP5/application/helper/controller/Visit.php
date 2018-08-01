<?php
namespace app\helper\controller;
use think\Controller;
use think\Db;
use app\request\controller\Request;
//use \app\admin\model\Common;
//分类管理控制器
class Visit extends controller
{
    public static $get_ip_url_taobao = 'http://ip.taobao.com/service/getIpInfo.php';
    public static function get_ip()
    {
        try {
            $realip = '';
            if(isset($_SERVER)){
                //如果客户端用了代理ip
                if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                    foreach ($arr AS $ip){
                        $ip = trim($ip);
                        if ($ip != 'unknown'){
                            $realip = $ip;
                            break;
                        }
                    }
                //代理ip
                }elseif (isset($_SERVER['HTTP_CLIENT_IP'])){
                    $realip = $_SERVER['HTTP_CLIENT_IP'];
                //握手ip，有代理则是代理ip，没有代理则是真实ip
                }else{
                    if (isset($_SERVER['REMOTE_ADDR'])){
                        $realip = $_SERVER['REMOTE_ADDR'];
                    }else{
                        $realip = '0.0.0.0';
                    }
                }
            }else{
                if (getenv('HTTP_X_FORWARDED_FOR')){
                    $realip = getenv('HTTP_X_FORWARDED_FOR');
                }elseif (getenv('HTTP_CLIENT_IP')){
                    $realip = getenv('HTTP_CLIENT_IP');
                }else{
                    $realip = getenv('REMOTE_ADDR');
                }
            }
            $code = 0;
            $msg = 'ok';
        } catch (\Exception $e) {
            $code = $e->getMessage();
            $msg = $e->getCode();
        }
        $data['code'] = $code;
        $data['msg'] = $msg;
        $data['data'] = $realip;
        return json_encode($data);

    }
    public static function visit_execute()
    {
        $data = self::get_ip();
        $data = json_decode($data,true);
        if($data['code'] != 0){
            return 'ip获取错误';
        }
        $local_page_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $ip['ip'] = $data['data'];
        $get_ip_info_url = self::$get_ip_url_taobao.'?ip='.$ip['ip'];
        $ip_info = json_decode(Request::curl_get($get_ip_info_url),true);
        $ip_info = json_decode($ip_info['data'],true);
        $ip_info = $ip_info['data'];
        $ip_info['vst_url'] = $local_page_url;
        return $ip_info;
    }
    public static function write_visit_log()
    {
        $ip_info = self::visit_execute();
        $ip_data['vst_ip'] = $ip_info['ip'];
        $ip_data['ip_country'] = $ip_info['country'];
        $ip_data['ip_province'] = $ip_info['region'];
        $ip_data['ip_city'] = $ip_info['city'];
        $ip_data['vst_at'] = time();
        $ip_data['vst_url'] = $ip_info['vst_url'];
        $res_ip = Db::name('visitor_log')->insertGetId($ip_data);
    }
}