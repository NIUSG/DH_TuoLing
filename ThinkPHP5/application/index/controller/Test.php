<?php
namespace app\index\controller;
use app\request\controller\Request;
use app\helper\controller\Visit;
class Test
{ 
	public function index()
	{ 
		/*$abc = Request::curl_get('http://ip.taobao.com/service/getIpInfo.php?ip=45.33.60.128');
		var_dump($abc);*/
		Visit::write_visit_log();
	}
}