<?php
//000000086400
 exit();?>
a:19:{s:11:"bloginfo_id";i:43;s:12:"bloginfo_oid";i:0;s:14:"bloginfo_title";s:46:"shell脚本编程学习笔记2——Bash变量";s:17:"bloginfo_describe";s:247:"shell脚本编程学习笔记2——Bash变量1，变量简介1，计算机内存单元

2，设置规则
&nbsp;&nbsp;&nbsp;&nbsp;字母数组下划线组成，不能以数字开头
&nbsp;&nbsp;&nbsp;&nbsp;Bash中，默认类型字符串型...";s:12:"bloginfo_img";s:28:"InitializeImg/initialize.jpg";s:15:"bloginfo_status";i:1;s:19:"bloginfo_createtime";i:1523287565;s:19:"bloginfo_updatetime";i:1523287565;s:8:"class_id";i:12;s:13:"bloginfo_like";i:0;s:13:"bloginfo_hate";i:0;s:14:"bloginfo_click";i:113;s:10:"created_at";s:19:"2018-04-09 23:26:05";s:4:"date";s:10:"2018-04-09";s:4:"time";s:8:"23:26:05";s:11:"class_title";s:5:"Linux";s:10:"label_list";a:1:{i:0;a:5:{s:8:"label_id";i:21;s:9:"label_oid";i:0;s:11:"label_title";s:5:"Shell";s:12:"label_status";i:1;s:16:"label_createtime";i:1522767633;}}s:12:"bloglink_url";a:1:{i:0;s:53:"http://www.niushao.net/index/content/index.html?id=42";}s:7:"content";s:33736:"<h3 style="margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">shell脚本编程学习笔记2——Bash变量</h3><p style="margin-top: 10px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">1，变量简介</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">1，计算机内存单元

2，设置规则
&nbsp;&nbsp;&nbsp;&nbsp;字母数组下划线组成，不能以数字开头
&nbsp;&nbsp;&nbsp;&nbsp;Bash中，默认类型字符串型，变量类型可修改</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">2，Bash变量规则</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">1，变量用等号连接值，等号左右两侧不能有空格。&nbsp;(Linux中空格代表命令之间的区分)
2，变量的值如果有空格，需要使用单引号或双引号包括。
3，在变量的值中，可以使用“\”转义符
4，如果需要变量拼接，那么可以进行变量值的叠加。不过变量需要用双引号包含&nbsp;“$变量名”或用${变量名}包含。&nbsp;
5，如果是把命令的结果作为变量值赋予变量，则需要使用反引号或$()包含命令
6，环境变量名建议大写，便于区分</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">3，变量分类</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">1，用户自定义变量，保存环境当前shell
2，环境变量，主要保存和系统操作环境相关数据
3，位置参数变量，主要用来向脚本传递数据，不可自定义，作用固定
4，预定义变量，Bash中定义好的变量，变量名不可自定义，作用固定</pre><h3 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">1，用户自定义变量</h3><p style="margin-top: 10px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">1，简介</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">在本地定义的变量，只适用于当前shell

注意：进入子shell
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bash
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退出子shell
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查询shell层级
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pstree</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">2，简单实例：</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">&nbsp;&nbsp;&nbsp;&nbsp;[root@iZwz9h901rvv69020rk7fsZ&nbsp;sh]#&nbsp;name=&quot;dun&nbsp;huang&quot;
&nbsp;&nbsp;&nbsp;&nbsp;[root@iZwz9h901rvv69020rk7fsZ&nbsp;sh]#&nbsp;echo&nbsp;&quot;$name&quot;
&nbsp;&nbsp;&nbsp;&nbsp;dun&nbsp;huang
&nbsp;&nbsp;&nbsp;&nbsp;[root@iZwz9h901rvv69020rk7fsZ&nbsp;sh]#&nbsp;name=&quot;$name&quot;&#39;&nbsp;de&nbsp;tuo&nbsp;ling&#39;
&nbsp;&nbsp;&nbsp;&nbsp;[root@iZwz9h901rvv69020rk7fsZ&nbsp;sh]#&nbsp;echo&nbsp;&quot;$name&quot;
&nbsp;&nbsp;&nbsp;&nbsp;dun&nbsp;huang&nbsp;de&nbsp;tuo&nbsp;ling
&nbsp;&nbsp;&nbsp;&nbsp;[root@iZwz9h901rvv69020rk7fsZ&nbsp;sh]#</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">3，操作：</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">&nbsp;&nbsp;&nbsp;&nbsp;变量调用&nbsp;[root@localhost&nbsp;~]#&nbsp;echo&nbsp;$name
&nbsp;&nbsp;&nbsp;&nbsp;变量查看&nbsp;[root@localhost&nbsp;~]#&nbsp;set
&nbsp;&nbsp;&nbsp;&nbsp;变量删除&nbsp;[root@localhost&nbsp;~]#&nbsp;unset&nbsp;name</pre><h3 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">2，环境变量</h3><p style="margin-top: 10px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">1，简介</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">用户自定义变量只在当前的Shell中生效，&nbsp;而环境变量会在当前Shell和这个Shell的所&nbsp;有子Shell当
中生效。如果把环境变量写入&nbsp;相应的配置文件，那么这个环境变量就会&nbsp;在所有的Shell中生效</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">2，设置</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">export&nbsp;变量名=变量值&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;申明变量
env&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;查询变量
unset&nbsp;变量名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;删除变量

注意：系统常见环境变量
&nbsp;&nbsp;&nbsp;&nbsp;1，$PATH
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[root@localhost&nbsp;~]#&nbsp;echo&nbsp;$PATH&nbsp;/usr/lib/qt-3.3/bin:/usr/local/sbin:/usr/local/bin:&nbsp;/sbin:/bin:/usr/sbin:/usr/bin:/root/bin
&nbsp;&nbsp;&nbsp;&nbsp;2,PS1
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PS1：定义系统提示符的变量&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\d：显示日期，格式为“星期&nbsp;月&nbsp;日”&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\h：显示简写主机名。如默认主机名“localhost”&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\t：显示24小时制时间，格式为“HH:MM:SS”&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\T：显示12小时制时间，格式为“HH:MM:SS”&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\A：显示24小时制时间，格式为“HH:MM”&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\u：显示当前用户名&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\w：显示当前所在目录的完整名称&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\W：显示当前所在目录的最后一个目录&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\#：执行的第几个命令&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$：提示符。如果是root用户会显示提示符为“#”，如果是普通用户&nbsp;会显示提示符为“$</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">3,实例</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">[root@localhost&nbsp;~]#&nbsp;PS1=&#39;[\u@\t&nbsp;\w]\$&nbsp;&#39;&nbsp;
[root@04:50:08&nbsp;/usr/local/src]#PS1=&#39;[\u@\@&nbsp;\h&nbsp;\#&nbsp;\W]\$‘&nbsp;
[root@04:53&nbsp;上午&nbsp;localhost&nbsp;31&nbsp;src]#PS1=&#39;[\u@\h&nbsp;\W]\$&nbsp;&#39;</pre><h3 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">3，位置参数变量</h3><p style="margin-top: 10px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">1，简介</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">$n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;n为数字，$0代表命令本身，$1-$9代表第一&nbsp;到第九个参数，十以上的参数需要用大括号&nbsp;包含，如${10}.&nbsp;
$*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这个变量代表命令行中所有的参数，$*把所&nbsp;有的参数看成一个整体&nbsp;
$@&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这个变量也代表命令行中所有的参数，不过&nbsp;$@把每个参数区分对待&nbsp;
$#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这个变量代表命令行中所有参数的个数</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">2，实例</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">#!/bin/bash&nbsp;
num1=$1&nbsp;
num2=$2&nbsp;sum=$((&nbsp;$num1&nbsp;+&nbsp;$num2))&nbsp;
#&nbsp;变量&nbsp;sum&nbsp;的和是&nbsp;num1&nbsp;加&nbsp;num2&nbsp;
echo&nbsp;$sum&nbsp;
#&nbsp;打印变量sum&nbsp;的值


#!/bin/bash&nbsp;
echo&nbsp;&quot;A&nbsp;total&nbsp;of&nbsp;$#&nbsp;parameters&quot;&nbsp;
#&nbsp;使用&nbsp;$#&nbsp;代表所有参数的个数
echo&nbsp;&quot;The&nbsp;parameters&nbsp;is:&nbsp;$*&quot;&nbsp;
#&nbsp;使用&nbsp;$*&nbsp;代表所有的参数
echo&nbsp;&quot;The&nbsp;parameters&nbsp;is:&nbsp;$@&quot;&nbsp;
#&nbsp;使用&nbsp;$@&nbsp;也代表所有参数



#!/bin/bash&nbsp;
for&nbsp;i&nbsp;in&nbsp;&quot;$*&quot;&nbsp;
#$*&nbsp;中的所有参数看成是一个整体，所以这个&nbsp;for&nbsp;循环只会循环一次
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;do&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;The&nbsp;parameters&nbsp;is:&nbsp;$i&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;done&nbsp;
x=1&nbsp;
for&nbsp;y&nbsp;in&nbsp;&quot;$@&quot;&nbsp;
#$@&nbsp;中的每个参数都看成是独立的，所以“&nbsp;$@&nbsp;”中有几个参数，就会循环几次
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;do&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;The&nbsp;parameter$x&nbsp;is:&nbsp;$y&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x=$((&nbsp;$x&nbsp;+1&nbsp;))&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;done</pre><h3 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">4，预定义变量</h3><p style="margin-top: 10px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">1，简介</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">$？&nbsp;最后一次执行的命令的返回状态。如果这个变&nbsp;量的值为0，证明上一个命令
&nbsp;&nbsp;&nbsp;&nbsp;正确执行；如果&nbsp;这个变量的值为非0（具体是哪个数，由命令&nbsp;自己来决定），则证明上一个命令执行不正确&nbsp;了。&nbsp;
$$&nbsp;&nbsp;当前进程的进程号（PID）&nbsp;
$!&nbsp;&nbsp;后台运行的最后一个进程的进程号（PID）</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">2，实例</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">#!/bin/bash&nbsp;
echo&nbsp;&quot;The&nbsp;current&nbsp;process&nbsp;is&nbsp;$$&quot;&nbsp;
#&nbsp;输出当前进程的&nbsp;PID&nbsp;。
#&nbsp;这个&nbsp;PID&nbsp;就是&nbsp;variable.sh&nbsp;这个脚本执行时，生成的进程的&nbsp;PID&nbsp;&nbsp;&nbsp;
find&nbsp;/root&nbsp;-name&nbsp;hello.sh&nbsp;&amp;&nbsp;
#&nbsp;使用&nbsp;find&nbsp;命令在&nbsp;root&nbsp;目录下查找&nbsp;hello.sh&nbsp;文件
#&nbsp;符号&nbsp;&amp;&nbsp;的意思是把命令放入后台执行，工作管理我们在系统管理章节&nbsp;会详细介绍
&nbsp;echo&nbsp;&quot;The&nbsp;last&nbsp;one&nbsp;Daemon&nbsp;process&nbsp;is&nbsp;$!&quot;</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; "><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">3，接受键盘输入</strong></p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 0px !important; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">[root@localhost&nbsp;~]#&nbsp;read&nbsp;[选项]&nbsp;[变量名]&nbsp;
选项：&nbsp;&nbsp;
-p&nbsp;“提示信息”：&nbsp;&nbsp;在等待read输入时，输出提示信息&nbsp;

-t&nbsp;秒数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：&nbsp;&nbsp;read命令会一直等待用户输入，使用此
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;选项可以指定等待时间&nbsp;&nbsp;

-n&nbsp;字符数&nbsp;&nbsp;：&nbsp;&nbsp;&nbsp;read命令只接受指定的字符数，就会执行

-s：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：&nbsp;&nbsp;&nbsp;隐藏输入的数据，适用于机密信息的输入&nbsp;


实例：
&nbsp;&nbsp;&nbsp;&nbsp;#!/bin/bash&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;read&nbsp;-t&nbsp;30&nbsp;-p&nbsp;&quot;Please&nbsp;input&nbsp;your&nbsp;name:&nbsp;&quot;&nbsp;name&nbsp;#&nbsp;提示“请输入姓名”并等待&nbsp;30&nbsp;秒，把用户的输入保存入变量&nbsp;name&nbsp;中
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;Name&nbsp;is&nbsp;$name&nbsp;&quot;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;read&nbsp;-s&nbsp;-t&nbsp;30&nbsp;-p&nbsp;&quot;Please&nbsp;enter&nbsp;your&nbsp;age:&nbsp;&quot;&nbsp;age&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;年龄是隐私，所以我们用“&nbsp;-s&nbsp;”选项隐藏输入
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;-e&nbsp;&quot;\n&quot;&nbsp;echo&nbsp;&quot;Age&nbsp;is&nbsp;$age&nbsp;&quot;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;read&nbsp;-n&nbsp;1&nbsp;-t&nbsp;30&nbsp;-p&nbsp;&quot;Please&nbsp;select&nbsp;your&nbsp;gender[M/F]:&nbsp;&quot;&nbsp;gender&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;使用“&nbsp;-n&nbsp;1&nbsp;”选项只接收一个输入字符就会执行（都不用输入回车）
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;-e&nbsp;&quot;\n&quot;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;Sex&nbsp;is&nbsp;$gender&quot;</pre><p><br/></p>";}