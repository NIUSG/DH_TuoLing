<?php
//000000000000
 exit();?>
a:8:{s:13:"nbbloginfo_id";i:5;s:14:"bloginfo_title";s:64:"mysql存储过程和函数(一)——简单的存储过程编写";s:19:"bloginfo_createtime";s:10:"2018-01-01";s:13:"bloginfo_like";i:0;s:13:"bloginfo_hate";i:0;s:14:"bloginfo_click";i:25;s:15:"blogcontent_ctt";s:21260:"<h3>存储过程</h3><hr/><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">存储过程简介：
&nbsp;&nbsp;&nbsp;&nbsp;能完成比较复杂的判断和运算
&nbsp;&nbsp;&nbsp;&nbsp;可编程性强，灵活
&nbsp;&nbsp;&nbsp;&nbsp;sql编程的代码可以重复使用
&nbsp;&nbsp;&nbsp;&nbsp;执行速度相对会快一些
&nbsp;&nbsp;&nbsp;&nbsp;减少网络之间的数据传输，节省开销</pre><hr/><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">准备工作：
dilimiter&nbsp;&nbsp;可以修改sql语句的结尾结束符。修改分号为其他符号，
因为存储过程和函数中有多个分号，多以需要用dilimiter修改结束符</pre><hr/><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">本博客使用测试数据库为mysql官方测试数据库sakila,mysql官网可下载</pre><hr/><h3><a></a>mysql简单存储过程</h3><p style="margin-top: 10px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">1，最简单的存储过程</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求：查询actor表中id为偶数的actor信息

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;sel_even_actor()
begin
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;*&nbsp;from&nbsp;actor&nbsp;where&nbsp;actor_id%2&nbsp;=&nbsp;0;
end;
$$

delimiter;
call&nbsp;sel_even_actor();

总结:
&nbsp;&nbsp;&nbsp;&nbsp;创建语法：create&nbsp;procedure&nbsp;procedure_Name;
&nbsp;&nbsp;&nbsp;&nbsp;包含一个以上的代码块，代码块要用begin,end之间包含；
&nbsp;&nbsp;&nbsp;&nbsp;在命令行中创建的情况下，需要使用定义分隔符delimiter&nbsp;$$，
&nbsp;&nbsp;&nbsp;&nbsp;创建结束并且要修改回来</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">2，存储过程中定义变量</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求：取出actor_id&nbsp;=&nbsp;28的演员名

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;sel_actorname_28()
begin&nbsp;
//定义变量，用来保存需要查询的名字
declare&nbsp;actorname_28&nbsp;varchar(64)&nbsp;default&nbsp;&quot;&quot;;
//set可以给变量赋值
set&nbsp;actorname_28&nbsp;=&nbsp;&#39;NiuShao&#39;;
//存储过程中也可以用into赋值
select&nbsp;concat(first_name,&#39;-&#39;,last_name)&nbsp;as&nbsp;name&nbsp;into&nbsp;actorname_28&nbsp;from&nbsp;actor&nbsp;where&nbsp;actor_id=28;
//显示查出的值
select&nbsp;actorname_28;
end;
$$

delimiter;
call&nbsp;sel_even_actor();

总结:
&nbsp;&nbsp;&nbsp;&nbsp;变量的声明使用declare语句，一个declare只能声明一个变量，变量必须先声明后使用
&nbsp;&nbsp;&nbsp;&nbsp;变量具有数据类型和长度，和myuql的sql数据类型保持一致，因此也可以指定默认值，字符集和排序规则
&nbsp;&nbsp;&nbsp;&nbsp;变量可以用set进行赋值，也可以用select&nbsp;into&nbsp;的方式赋值
&nbsp;&nbsp;&nbsp;&nbsp;变量如果需要返回，可以使用select语句，例如：select&nbsp;变量名


需求：取出actor,film表的行数以及actor表名字用A开头的演员和film中用B开头的电影

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;sel_actor_film()
begin
&nbsp;&nbsp;&nbsp;&nbsp;begin&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;a_sum&nbsp;int&nbsp;default&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;f_sum&nbsp;int&nbsp;default&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;count(*)&nbsp;into&nbsp;a_sum&nbsp;from&nbsp;actor;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;count(*)&nbsp;into&nbsp;f_sum&nbsp;from&nbsp;film;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;a_sum,f_sum;
&nbsp;&nbsp;&nbsp;&nbsp;end;
&nbsp;&nbsp;&nbsp;&nbsp;begin&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;a_a&nbsp;varchar(64)&nbsp;default&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;f_a&nbsp;varchar(64)&nbsp;default&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;concat(first_name,&#39;-&#39;,last_name)&nbsp;into&nbsp;a_a&nbsp;from&nbsp;actor&nbsp;where&nbsp;first_name&nbsp;like&nbsp;&quot;A%&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;title&nbsp;into&nbsp;f_a&nbsp;from&nbsp;film&nbsp;where&nbsp;title&nbsp;like&nbsp;&#39;A%&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;a_a,f_a;
&nbsp;&nbsp;&nbsp;&nbsp;end;
end;
$$

delimiter&nbsp;;
call&nbsp;sel_actor_film();//这里第二个代码块因为超过了一行，调用的时候无法显示。所以变量只能保存一个数据来输出

注意:变量是有作用域的，作用范围在begin和end块之间,end结束变量的作用范围即结束
&nbsp;&nbsp;&nbsp;&nbsp;需要多个块之间传递值，可以使用全局变量，即放在所有代码块之前
&nbsp;&nbsp;&nbsp;&nbsp;传参变量是全局的，可以在多个代码块之间起作用</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">3，存储过程的传入参数IN</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求:传入参数actor_id,取出该id下的演员名字

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;sel_actorname_in(actorid&nbsp;int)
begin
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;actorname&nbsp;varchar(64)&nbsp;default&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;concat(first_name,&#39;-&#39;,last_name)&nbsp;as&nbsp;name&nbsp;into&nbsp;actorname&nbsp;from&nbsp;actor&nbsp;where&nbsp;actor_id&nbsp;=&nbsp;actorid;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;actorname;
end;
$$
delimiter&nbsp;;

call&nbsp;sel_actorname_in(28);

总结:传入参数，类型为IN，表示该参数的值必须在调用存储过程的时候指定，如果不是指定为IN，默认就是IN类型
&nbsp;&nbsp;&nbsp;&nbsp;IN类型参数一般只用于传入，在调用的过程中一般不做修改和返回
&nbsp;&nbsp;&nbsp;&nbsp;如果调用存储过程中需要修改和返回值，可以使用out类型参数</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">4，存储过程的传入参数OUT</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求:传入film_id,输出电影title

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;sel_film_out(in&nbsp;id&nbsp;int,out&nbsp;name&nbsp;varchar(64))
begin
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;title&nbsp;into&nbsp;name&nbsp;from&nbsp;film&nbsp;where&nbsp;film_id=id;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;name;
end;
$$
delimiter&nbsp;;

set&nbsp;@name=&quot;&quot;;&nbsp;&nbsp;&nbsp;//mysql中命令行定义变量
call&nbsp;sel_film_out(1,@name);&nbsp;//mysql中命令行调用变量

归纳:
&nbsp;&nbsp;&nbsp;&nbsp;传出参数，在调用存储过程中，可以改变值，并且可以返回
&nbsp;&nbsp;&nbsp;&nbsp;out是传出参数，不能用于传入参数的值
&nbsp;&nbsp;&nbsp;&nbsp;调用存储过程时，out参数也需要指定，但必须是变量，不能是常量
&nbsp;&nbsp;&nbsp;&nbsp;如果既需要传入参数，同时有需要传出参数，可以使用INOUT类型参数</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">5，存储过程的可变参数INOUT</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求：传入file_id,同时传出title,file_id

delimiter&nbsp;$$
&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;procedure&nbsp;sel_film_inout(inout&nbsp;id&nbsp;int,inout&nbsp;name&nbsp;varchar(64))
&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;film_id,title&nbsp;into&nbsp;id,name&nbsp;from&nbsp;film&nbsp;where&nbsp;film_id=id;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;id,name;
&nbsp;&nbsp;&nbsp;&nbsp;end;
$$
delimiter&nbsp;;

set&nbsp;@name=&quot;&quot;;
set&nbsp;@id=&quot;28&quot;;
call&nbsp;sel_film_inout(@id,@name);

归纳：
&nbsp;&nbsp;&nbsp;&nbsp;可变变量inout,调用额时候可传入值，在调用过程中可以修改它的值，同时也能返回值
&nbsp;&nbsp;&nbsp;&nbsp;inout&nbsp;参数集合了in和out类型的参数功能
&nbsp;&nbsp;&nbsp;&nbsp;inout调用的时候传入的是变量，而不是常量</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">6，存储过程中的条件语句</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求:编写存储过程,如果id为偶数，给我title。如果为奇数，给出id

delimiter&nbsp;$$
&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;procedure&nbsp;sel_film_if(IN&nbsp;id&nbsp;int)
&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;name&nbsp;varchar(32)&nbsp;default&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(id%2=0)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;title&nbsp;into&nbsp;name&nbsp;from&nbsp;film&nbsp;where&nbsp;film_id&nbsp;=&nbsp;id;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;name;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;id;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;if;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;end;
$$
delimiter&nbsp;;

call&nbsp;sel_film_if(29);
call&nbsp;sel_film_if(28);

归纳:
&nbsp;&nbsp;&nbsp;&nbsp;条件语句最基本的结构&nbsp;if()&nbsp;then&nbsp;……else……end&nbsp;if;
&nbsp;&nbsp;&nbsp;&nbsp;引申为&nbsp;if()&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;……
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;elseif()&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;……
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;elseif()&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;……
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;if;
&nbsp;&nbsp;&nbsp;&nbsp;if判断返回逻辑的真假，表达式可以是任意返回真假的表达式</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">7,while循环语句</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求：
&nbsp;&nbsp;&nbsp;&nbsp;创建只有id的表，并且插入一万条数据

create&nbsp;table&nbsp;test_while(&nbsp;
`id`&nbsp;int&nbsp;not&nbsp;null
);

delimiter&nbsp;$$
&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;procedure&nbsp;insert_test()
&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;i&nbsp;int&nbsp;default&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while(i&lt;=10000)&nbsp;do
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;i;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;set&nbsp;i&nbsp;=&nbsp;i+1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;insert&nbsp;into&nbsp;test_while(id)values(i);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;while;
&nbsp;&nbsp;&nbsp;&nbsp;end;
$$
delimiter&nbsp;;

call&nbsp;test_while();

归纳:
&nbsp;&nbsp;&nbsp;&nbsp;while语句最基本的结构
&nbsp;&nbsp;&nbsp;&nbsp;while()do
&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;end;
&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;while;

&nbsp;&nbsp;&nbsp;&nbsp;while判断返回逻辑的真假，表达式可以是任意返回真假的表达式</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;"><strong style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;">8，repeat循环语句</strong></p><pre style="margin-top: 15px; margin-bottom: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px;">需求:同while的测试表，降序插入10000条语句

delimiter&nbsp;$$
&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;procedure&nbsp;insert_repeat()
&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;i&nbsp;int&nbsp;default&nbsp;10001;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;repeat
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;i;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;set&nbsp;i&nbsp;=&nbsp;i-1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;insert&nbsp;into&nbsp;test_while(id)values(i);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;until&nbsp;i&lt;0
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;repeat;
&nbsp;&nbsp;&nbsp;&nbsp;end;
$$
delimiter&nbsp;;

归纳:
&nbsp;&nbsp;&nbsp;&nbsp;repeat语句最基本的结构，repeat
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;……
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;untile……
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;repeat;
&nbsp;&nbsp;&nbsp;&nbsp;until判断返回逻辑的真或者假，表达式可以是任意返回真或者i假的表达式，只有当until语句为真的时候，循环结束。</pre><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; border-width: 0px;">9，游标</p><pre style="margin-top: 15px; padding: 6px 10px; border-width: 1px; font-size: 13px; font-family: Consolas, &quot;Liberation Mono&quot;, Courier, monospace; border-style: solid; border-color: rgb(204, 204, 204); line-height: 19px; margin-bottom: 0px !important;">简介:mysql中的游标，就是保存查询结果的临时内存区域

需求：编写存储过程,使用游标把film_id为偶数的记录加后缀

delimiter&nbsp;$$
create&nbsp;procedure&nbsp;film_cursor()
begin
&nbsp;&nbsp;&nbsp;&nbsp;//定义停止循环的变量
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;stopwhile&nbsp;int&nbsp;default&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;//定义变量获取当前游标的值
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;name&nbsp;varchar(64);
&nbsp;&nbsp;&nbsp;&nbsp;//定义游标变量，保存当前查询结果
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;name_cursor&nbsp;cursor&nbsp;for&nbsp;select&nbsp;title&nbsp;from&nbsp;film&nbsp;where&nbsp;film_id%2=0;
&nbsp;&nbsp;&nbsp;&nbsp;//continue&nbsp;handler&nbsp;是游标句柄，如果游标结束，则改变循环变量的值
&nbsp;&nbsp;&nbsp;&nbsp;declare&nbsp;continue&nbsp;handler&nbsp;for&nbsp;not&nbsp;found&nbsp;set&nbsp;stopwhile&nbsp;=&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;//打开游标，也就是当前定义的游标变量
&nbsp;&nbsp;&nbsp;&nbsp;open&nbsp;name_cursor;
&nbsp;&nbsp;&nbsp;&nbsp;//获取当前游标变量，赋值给name
&nbsp;&nbsp;&nbsp;&nbsp;fetch&nbsp;name_cursor&nbsp;into&nbsp;name;
&nbsp;&nbsp;&nbsp;&nbsp;//循环修改
&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;(stopwhile=0)&nbsp;do
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;begin
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;update&nbsp;film&nbsp;set&nbsp;title&nbsp;=&nbsp;concat(name,&#39;_NiuShao&#39;)&nbsp;where&nbsp;title&nbsp;=&nbsp;name;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fetch&nbsp;name_cursor&nbsp;into&nbsp;name;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end;
&nbsp;&nbsp;&nbsp;&nbsp;end&nbsp;while;
&nbsp;&nbsp;&nbsp;&nbsp;//关闭游标
&nbsp;&nbsp;&nbsp;&nbsp;close&nbsp;name_cursor;
end;
$$
delimiter&nbsp;;

call&nbsp;film_cursor()

归纳:
&nbsp;&nbsp;&nbsp;&nbsp;定义游标变量，变量名后加&nbsp;cursor
&nbsp;&nbsp;&nbsp;&nbsp;游标变量是一个select&nbsp;语句赋值，fetch一次，查一次，直到查询结束，也就是游标句柄找不到。赋值用&nbsp;for
&nbsp;&nbsp;&nbsp;&nbsp;使用游标需要开启游标和关闭游标</pre><p><br/></p>";s:11:"class_title";s:9:"数据库";}