<?php
namespace app\index\model;
use think\Model;
use think\cache\driver\File;
use app\index\controller\Common;
class TotalModel extends Model
{
    public $file_cache_obj;
    public $common_index_obj;
    public function __construct()
    {
        $this->file_cache_obj = new File();
        $this->common_index_obj = new Common();
    }
}