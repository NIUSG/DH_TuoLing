<?php
namespace app\index\model;
use think\Model;
use think\Db;
class LinkModel extends CommonModel
{
    public function get_link_clicknum()
    {
        $sql = "SELECT
                        link_id,link_title,link_url
                FROM
                        ns_link
                WHERE
                        link_status = 1
                ORDER BY
                        link_clicknum DESC
                LIMIT 20";
        $res = Db::query($sql);
        return $res;
    }
}