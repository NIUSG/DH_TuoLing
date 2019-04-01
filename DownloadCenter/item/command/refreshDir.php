<?php
$dir = dirname(dirname(dirname(__FILE__)));
$resource = $dir.'/resource/';
if(!is_dir($resource)){
  var_dump('NOT EXISTS');
}