create table ns_visit_cache(
`id` int unsigned not null primary key auto_increment,
`k` char(32) not null,
`data` text not null,
`status` enum('y','n') not null default 'n'
)engine=innodb default charset=utf8 comment='访问统计临时表';

alter table ns_visitor_log add vst_date timestamp not null default "0000-00-00 00:00:00" after vst_at;
alter table ns_visitor_log modify vst_url text not null;