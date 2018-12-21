<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'index'     => [
        '__file__'   => ['common.php','config.php',],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index','Blog','Link','Category','Common','Label'],
        'model'      => ['IndexModel','BlogModel','LinkModel','CategoryModel'],
    ],
    'admin'     => [
        '__file__'   => ['common.php','config.php'],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index','Blog','Link','Category','Common'],
        'model'      => ['IndexModel','BlogModel','LinkModel','CategoryModel'],
    ],
    'console'     => [
        '__file__'   => ['common.php','config.php'],
        '__dir__'    => ['controller', 'model','service'],
        'controller' => ['Index','Visit','VisitIpLog','Test'],
        'model'      => ['IndexModel','VisitModel','VisitIpLogModel','TestModel'],
        'service'    => ['IndexService','VisitService','VisitIpLogService','TestService'],
    ],
    'tools'     => [
        '__file__'   => ['common.php','config.php'],
        '__dir__'    => ['controller', 'model'],
        'controller' => ['GetIp','Redis','Index','Visit','Request','Log'],
    ],
    // 其他更多的模块定义
    'Test'     => [
        '__file__'   => ['common.php','config.php',],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Test'],
        'model'      => ['TestModel'],
    ],
];
