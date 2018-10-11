create table ns_visit_cache(
`id` int unsigned not null primary key auto_increment,
`k` char(32) not null,
`data` text not null,
`status` enum('y','n') not null default 'n'
)engine=innodb default charset=utf8 comment='访问统计临时表';