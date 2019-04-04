<?php
namespace app\exec;
use core\coreClass\test;
class App
{
    private $db;
    public function __construct()
    {
         $this->db = new \core\coreClass\DatabaseOperate(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
    public function run()
    {
        $sourceList = $this->getSource();
        require_once VIEW_PATH.'download.html';
    }
    public function getSource()
    {
        $sql = "select name,cur_path from ns_download_center where status = 1";
        $sourceList = $this->db->getAllArray($sql);
        $sourceList = array_map(function($v){
            $v['download_path'] = RESOURCE_DOMAIN.$v['cur_path'];
            return $v;
        },$sourceList);
        return $sourceList;
    }
}