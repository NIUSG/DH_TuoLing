<?php
//文件中心
$dir = dirname(dirname(dirname(__FILE__)));

$resource = $dir.'/resource/';
//文件中心是否存在
if(!is_dir($resource)){
  var_dump('NOT EXISTS');
  die();
}

function myscandir1($path, &$arr) {

    foreach (glob($path) as $file) {
        if (is_dir($file)) {
            myscandir1($file . '/*', $arr);
        } else {

            $arr[] = realpath($file);
        }
    }
}

$arr = [];
myscandir1('D:/',$arr);
var_dump($arr);die();
