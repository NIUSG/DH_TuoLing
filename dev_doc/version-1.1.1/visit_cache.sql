create table ns_visit_cache(
`id` int unsigned not null primary key auto_increment,
`ip` varchar(16) not null,
`url` varchar(255) not null,
`time` timestamp not null default '0000-00-00 00:00:00',
`status` enum('y','n') not null default 1 comment 'y:已经处理,n:没有处理',
)engine=innodb default charset=utf8 comment '访问统计临时表';