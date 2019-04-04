create table if not exists `ns_download_center`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT primary key,
  `name` varchar(255) not null,
  `path` varchar(255) not null,
  `cur_path` varchar(255) not null,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `download_num` int not null default 0,
  `status` enum('0','1') not null default 1 COMMENT "0：禁用1：启用"
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='软件下载模块的表,下载表';