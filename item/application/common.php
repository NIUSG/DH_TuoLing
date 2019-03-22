<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//全局日志记录方法,日志路径定死在runtime/log中
function WL($msg,$log_name)
{
    $path = dirname(dirname(__FILE__))."/runtime/log/WL/";
    is_dir($path) or mkdir($path,0777,true);
    $time = time();
    $day = date('Y-m-d',$time);
    $date_time = date('Y-m-d H:i:s',$time);
    $file = $path.$log_name.'-'.$day.'.log';
    $msg = '['.$date_time.'] '.$msg.PHP_EOL;
    file_put_contents($file,$msg,FILE_APPEND);
}
//导出excel
 /**
 * 导出数据为excel表格
 *
 * @param $data 一个二维数组,结构如同从数据库查出来的数组
 * @param $title excel的第一行标题,一个数组,如果为空则没有标题
 * @param $filename 下载的文件名
 *          @examlpe
 *          $stu = M ('User');
 *          $arr = $stu -> select();
 *          exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */
function exportexcel($data = array(), $title = array(), $filename = 'report') {
  header ( "Content-type:application/octet-stream" );
  header ( "Accept-Ranges:bytes" );
  header ( "Content-type:application/vnd.ms-excel" );
  header ( "Content-Disposition:attachment;filename=" . $filename . ".xls" );
  header ( "Pragma: no-cache" );
  header ( "Expires: 0" );
  // 导出xls 开始
  if (! empty ( $title )) {
    foreach ( $title as $k => $v ) {
      $title [$k] = iconv ( "UTF-8", "GB2312", $v );
    }
    $title = implode ( "\t", $title );
    echo "$title\n";
  }
  if (! empty ( $data )) {
    foreach ( $data as $key => $val ) {
      foreach ( $val as $ck => $cv ) {
        $data [$key] [$ck] = iconv ( "UTF-8", "GB2312", $cv );
      }
      $data [$key] = implode ( "\t", $data [$key] );
    }
    echo implode ( "\n", $data );
  }
}