<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/public/header.html";i:1545274232;s:88:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/blog/content.html";i:1545279500;s:75:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/base/base.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/header.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/footer.html";i:1545274232;}*/ ?>
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
    <link href="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/css/index.css" rel="stylesheet">

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
<h1 class="t_nav"><span>博客详情</span><a href="/" class="n1">博客展示</a><a href="/" class="n2">博客</a></h1>
<div class="about left">
    <h2><?php echo $list['content_info']['bloginfo_title']; ?></h2>
    <ul>
        <?php echo $list['content_info']['content']; ?>
    </ul>
    <h2>Comment</h2>
    <!--
    <p>Óò  Ãû£ºwww.yangqq.com ´´½¨ÓÚ2011Äê01ÔÂ12ÈÕ <a href="/" class="blog_link" target="_blank">×¢²áÓòÃû</a></p>
    <p>·þÎñÆ÷£º°¢ÀïÔÆ·þÎñÆ÷<a href="/" class="blog_link" target="_blank">¹ºÂò¿Õ¼ä</a></p>
    <p>±¸°¸ºÅ£ºÊñICP±¸11002373ºÅ-1</p>
    <p>³Ì  Ðò£ºPHP µÛ¹úCMS7.0</p>
    -->
</div>
<aside class="right">
    <div class="about_c">
    <p>博客名: <span><?php echo $list['content_info']['bloginfo_title']; ?></span></p>
    <p>所属分类: <span><?php echo $list['content_info']['class_title']; ?></span></p>
    <p>发布日期:<?php echo $list['content_info']['created_at']; ?></p>
    <p>浏览量<span><?php echo $list['content_info']['bloginfo_click']; ?></span></p>
    <p>顶<span><?php echo $list['content_info']['bloginfo_like']; ?></span></p>
    <p>踩<span><?php echo $list['content_info']['bloginfo_hate']; ?></span></p>
    </div>
    <div class="news">
    <h3>
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="rank">
    <?php foreach($list['right_list']['blog_clicknum'] as $val): ?>
      <li><a href="<?php echo url('content/index'); ?>?id=<?php echo $val['bloginfo_id']; ?>" target="_blank"><?php echo $val['bloginfo_title']; ?>(<?php echo $val['bloginfo_click']; ?>)</a></li>
    <?php endforeach; ?>
    </ul>
    <h3 class="ph">
      <p>最新<span>发布</span></p>
    </h3>
    <ul class="paih">
    <?php foreach($list['right_list']['blog_latest_publish'] as $val): ?>
      <li><a href="<?php echo url('content/index'); ?>?id=<?php echo $val['bloginfo_id']; ?>" target="_blank"><?php echo $val['bloginfo_title']; ?></a></li>
    <?php endforeach; ?>
    </ul>
    <h3 class="links">
      <p>常用<span>链接</span></p>
    </h3>
    <ul class="website">
      <li><a href="http://www.github.com" target="_blank">GITHUB</a></li>
      <li><a href="http://www.linode.com" target="_blank">Linode</a></li>
      <li><a href="http://www.aliyun.com" target="_blank">阿里云</a></li>
      <li><a href="http://www.baiduc.com" target="_blank">百度</a></li>
    </ul>
    </div>
    <div class="cloud">
      <h3>标签</h3>
      <ul>
      <?php foreach($list['right_list']['link_clicknum'] as $val): ?>
        <li><a href="<?php echo $val['link_url']; ?>"><?php echo $val['link_title']; ?></a></li>
      <?php endforeach; ?>
      </ul>
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