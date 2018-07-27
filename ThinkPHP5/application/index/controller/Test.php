<?php
namespace app\index\controller;
use app\request\controller\Request;
class Test
{ 
	public function index()
	{ 
		Request::curl_get(15);
	}
}