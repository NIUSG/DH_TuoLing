create table ns_visit_cache(
`key` char(32) not null primary key,
`data` text not null
)engine=innodb default charset=utf8 comment='访问统计临时表';