<?php
//文件中心
$dir = dirname(dirname(dirname(__FILE__)));
$resource = $dir.'/resource/';
//文件中心是否存在
if(!is_dir($resource)){
  var_dump('NOT EXISTS');
  die();
}
$file = scandir($resource);
var_dump($file);die();
