<?php
namespace command\exec;
use \core\coreClass\Common;
class App
{
    public function run()
    {
        //检测目录以及检测资源
        Common::checkSourceDir();
        //获取资源列表
        $sourceList = Common::cursionDir(RESOURCE_CENTER,2);
        var_dump($sourceList);die();
    }
}