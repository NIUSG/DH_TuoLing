<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/public/header.html";i:1545274232;s:89:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/aboutme/index.html";i:1545274232;s:75:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/base/base.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/header.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/footer.html";i:1545274232;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>NiuShao Blog</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="keywords" content="NiuShao Blog" />
    <meta name="description" content="NiuShao Blog" />
    <link href="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/css/base.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/js/modernizr.js"></script>
    <![endif]-->
    
    <link href="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/css/about.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>

    <script src="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/js/silder.js"></script>
    

</head>
<body>
    
        <body>
<header>
  <div id="logo"><a href="<?php echo url('index/index'); ?>"><h1>WWW.NIUSHAO.NET</h1></a></div>
  <nav class="topnav" id="topnav">
    <a href="<?php echo url('index/index'); ?>"><span>Home</span><span class="en">Protal</span></a>
    <?php foreach($top_class_list as $val): ?>
    <a href="<?php echo $val['url']; ?>"><span><?php echo $val['class_title']; ?></span><span class="en"><?php echo $val['class_Etitle']; ?></span></a>
    <?php endforeach; ?>
  </nav>
</header>
    
    
<article class="aboutcon">
<h1 class="t_nav"><span></span><a href="/" class="n1"><h3>About Me</h3></a><a href="/" class="n2"></a></h1>
<div class="about left">
    <ul> 
    </ul>
    <h2>NiuShao</h2>
    <p>网站域名<a href="http://www.niushao.net" class="blog_link" target="_blank">NiuShao.net/NiuShao.me</a></p>
    <p>网站服务<a href="http://www.linode.com" class="blog_link" target="_blank">LinodeVPS</a></p>
    <p>前端模版<a href="http://www.yangqq.com" class="blog_link" target="_blank">杨青的博客</a></p>
    <p>开发框架<a href="http://www.thinkphp.cn" class="blog_link" target="_blank">ThinkPHP5</a></p>
    <p>网站架构<a href="https://lnmp.org/" class="blog_link" target="_blank">LAMP</a></p>
    <p>上线日期：2018-01-01</p>
    <p>本站介绍：本站为NiuShao的技术总结和生活点滴的Blog网站。前端由<a href="http://www.yangqq.com" target="_blank">杨青的博客</a>提供模板，后端由站长自己用TP5框架独立开发完成。由于最近比较忙，又紧急需要上线，所以第一版仅提供博客展示的功能。其他功能模块待后续开发。本站服务器部署在美国Fremont的linode主机上面,所以访问会比较慢。由于备案没有下来，只能等年后在国内阿里云部署。另外两个域名分别来自<a href="https://wanwang.aliyun.com/" target="_blank">万网</a>和<a href="https://sg.godaddy.com/" target="_blank">GodAddy</a></p>
    <p>站长介绍：流浪在珠三角的90后草根码农，2015年入行，主攻php后端开发。很geek，很闷，新年计划攻略下python和java。平时闲下来喜欢一个人做一些有意义的事。羽毛球，跑步，健身爱好者。</p>
</div>
<aside class="right">  
    <div class="about_c">
    <p>博主简介:<span></span></p>
    <p>昵称：敦煌的驼铃</p>
    <p>地址：广州/深圳</p>
    <p>微博：</p>
    <p>知乎：<a href="https://www.zhihu.com/people/siukongngau/activities" target="_blank">敦煌的驼铃<a></p>
    <p>csdn：<a href="http://blog.csdn.net/siukong_ngau" target="_blank">敦煌的驼铃CSDN_BLOG</a></p>
    <p>微信：SiuKong_Ngau</p>
    <p>邮箱：siukong_ngau@163.com</p>
    <p>Q&nbsp;Q：370574131</p>
</div>     
</aside>
</article>

    
        <footer>
  <p>Design by NiuShao <a href="http://www.niushao.net/" target="_blank">Private Blog Web</a> <a href="/"></a></p>
</footer>
</body>
</html>
    
</body>
</html>