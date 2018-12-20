<?php
//000000086400
 exit();?>
a:19:{s:11:"bloginfo_id";i:53;s:12:"bloginfo_oid";i:0;s:14:"bloginfo_title";s:35:"java内部类——1成员内部类";s:17:"bloginfo_describe";s:379:"                                java内部类内部类分类概念：就是将一个类定义在另一个类的内部

成员内部类
静态内部类
匿名内部类
局部内部类内部类的功能特点1，实现隐藏，用protected和private修饰
2，内部类可以直接访问外部所有成员，包含私有
3，外部内不能直...                            ";s:12:"bloginfo_img";s:28:"InitializeImg/initialize.jpg";s:15:"bloginfo_status";i:1;s:19:"bloginfo_createtime";i:1543931099;s:19:"bloginfo_updatetime";i:1543931099;s:8:"class_id";i:20;s:13:"bloginfo_like";i:0;s:13:"bloginfo_hate";i:0;s:14:"bloginfo_click";i:9;s:10:"created_at";s:19:"2018-12-04 21:44:59";s:4:"date";s:10:"2018-12-04";s:4:"time";s:8:"21:44:59";s:11:"class_title";s:4:"JAVA";s:10:"label_list";a:1:{i:0;a:5:{s:8:"label_id";i:22;s:9:"label_oid";i:0;s:11:"label_title";s:4:"JAVA";s:12:"label_status";i:1;s:16:"label_createtime";i:1537881783;}}s:12:"bloglink_url";a:0:{}s:7:"content";s:12892:"<h3 style="margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 18px; ">java内部类</h3><h5 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 14px; ">内部类分类</h5><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">概念：就是将一个类定义在另一个类的内部

成员内部类
静态内部类
匿名内部类
局部内部类</pre><h5 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 14px; ">内部类的功能特点</h5><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">1，实现隐藏，用protected和private修饰
2，内部类可以直接访问外部所有成员，包含私有
3，外部内不能直接访问内部类的成员,必须首先建立内部类对象才能访问
4，内部类解决的问题，比如间接的实现多继承，避免修改接口而实现同一个类中两种同名方法的调用</pre><h5 style="margin-top: 20px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 14px; ">1，成员内部类</h5><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">成员内部类，外部类的实例成员，可以用四种权限修饰符调用。

互相调用方法：
&nbsp;&nbsp;&nbsp;&nbsp;内部调用外部：&nbsp;外部类名.this.成员方法/属性
&nbsp;&nbsp;&nbsp;&nbsp;外部调用内部：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;外部类名.内部类名&nbsp;实例名&nbsp;=&nbsp;外部类实例名.new&nbsp;内部类

注意：
&nbsp;&nbsp;&nbsp;&nbsp;1，成员内部类和外部类不可以重名
&nbsp;&nbsp;&nbsp;&nbsp;2，不能再成员内部类中定义static属性，方法，类。static&nbsp;final&nbsp;形式定义的常量除外</pre><p style="margin-top: 15px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; ">代码示例</p><pre style="margin-top: 15px; margin-right: 0px; margin-bottom: 0px !important; margin-left: 0px; padding-top: 6px; padding-right: 10px; padding-bottom: 6px; padding-left: 10px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: initial; border-color: initial; font-size: 13px; font-family: Consolas, &#39;Liberation Mono&#39;, Courier, monospace; background-color: rgb(248, 248, 248); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); line-height: 19px; overflow-x: auto; overflow-y: auto; border-top-left-radius: 3px 3px; border-top-right-radius: 3px 3px; border-bottom-right-radius: 3px 3px; border-bottom-left-radius: 3px 3px; ">//简单成员内部类的定义以及互相调用
public&nbsp;class&nbsp;InnerClass
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;void&nbsp;main(String&nbsp;[]&nbsp;args)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;INNER&nbsp;CLASS&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OuterClass&nbsp;outer&nbsp;=&nbsp;new&nbsp;OuterClass();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;outer.outer_show();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//System.out.println(outer.name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//System.out.println(outer.outer_int);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OuterClass.InnerClass&nbsp;inner&nbsp;=&nbsp;outer.new&nbsp;InnerClass();//内部类的调用以及实例化
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(inner.static_v);
&nbsp;&nbsp;&nbsp;&nbsp;}
}

class&nbsp;OuterClass
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;String&nbsp;name=&quot;My&nbsp;name&nbsp;is&nbsp;OuterClass&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;int&nbsp;outer_int&nbsp;=&nbsp;8;
&nbsp;&nbsp;&nbsp;&nbsp;InnerClass&nbsp;inner_class&nbsp;=&nbsp;new&nbsp;InnerClass();//内部类在外部类内部调用
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;outer_show()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(outer_int);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inner_class.inner_show();//外部内调用内部类方法
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;class&nbsp;InnerClass//内部类可以用三种修饰符修饰，除public外，其他修饰符修饰的，只能在内部使用
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;String&nbsp;name=&quot;My&nbsp;name&nbsp;is&nbsp;InnerClass&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;int&nbsp;inner_int&nbsp;=&nbsp;16;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//public&nbsp;static&nbsp;String&nbsp;static_v&nbsp;=&nbsp;&quot;static_v&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;final&nbsp;String&nbsp;static_v&nbsp;=&nbsp;&quot;static_v&quot;;//不能定义静态属性，static。但是能定义static&nbsp;final修饰的常量
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;inner_show()
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OuterClass.this.outer_show()//调用外部内的方法。如果不重名，可以省略前面的
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(inner_int);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;inner&quot;);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
}

利用内部类间接实现多继承

public&nbsp;class&nbsp;InnerClass2
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;void&nbsp;main(String&nbsp;[]&nbsp;args)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;c_obj&nbsp;=&nbsp;new&nbsp;C();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.D&nbsp;d_obj&nbsp;=&nbsp;c_obj.new&nbsp;D();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d_obj.showA();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.E&nbsp;e_obj&nbsp;=&nbsp;c_obj.new&nbsp;E();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e_obj.showB();

&nbsp;&nbsp;&nbsp;&nbsp;}
}

class&nbsp;A
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;showA()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;A&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}
class&nbsp;B
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;showB()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;B&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}

class&nbsp;C
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;class&nbsp;D&nbsp;extends&nbsp;A
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;};
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;class&nbsp;E&nbsp;extends&nbsp;B
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;};
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;showC()
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;}

}

利用内部类实现接口和抽象类同名方法的继承

public&nbsp;class&nbsp;InnerClass3
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;void&nbsp;main(String&nbsp;[]&nbsp;args)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;c_obj&nbsp;=&nbsp;new&nbsp;C();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c_obj.show();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.D&nbsp;d_obj&nbsp;=&nbsp;c_obj.new&nbsp;D();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d_obj.show();
&nbsp;&nbsp;&nbsp;&nbsp;}
}

abstract&nbsp;class&nbsp;A
{
&nbsp;&nbsp;&nbsp;&nbsp;abstract&nbsp;public&nbsp;void&nbsp;show();
}

interface&nbsp;B
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;show();
}

/*class&nbsp;C&nbsp;extends&nbsp;A&nbsp;implements&nbsp;B
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;show()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;why&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}*/

class&nbsp;C&nbsp;extends&nbsp;A
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;class&nbsp;D&nbsp;implements&nbsp;B
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;show()
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;func&nbsp;B&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;void&nbsp;show()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(&quot;func&nbsp;A&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}</pre><p><br/></p>";}