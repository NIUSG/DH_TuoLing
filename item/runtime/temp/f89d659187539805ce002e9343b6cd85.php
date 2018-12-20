<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/public/header.html";i:1545274232;s:86:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/blog/index.html";i:1545280440;s:75:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/base/base.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/header.html";i:1545274232;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/footer.html";i:1545274232;}*/ ?>
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
    
    <link href="http://139.199.230.187/DH_TuoLing/item/public/static/IndexStyle/css/style.css" rel="stylesheet">

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
    
    
<article class="blogs">
<h1 class="t_nav"><span><form action="<?php echo url('blog/index'); ?>"　method="get"><input type="text" name="search_key"><input type="submit" value="搜索"></form></span><a href="/" class="n1">博客</a><a href="/" class="n2">列表</a></h1>
<div class="newblog left">
    <?php foreach($list['blog_list'] as $val): ?>
   <h2><?php echo $val['bloginfo_title']; ?></h2>
   <p class="dateview"><span>发布日期:<?php echo $val['created_at']; ?></span><span></span><span>类别[<a href="/news/life/"><?php echo $val['class_title']; ?></a>]</span></p>
    <figure><img src="http://139.199.230.187/DH_TuoLing/item/public/uploads/BlogsImg/<?php echo $val['bloginfo_img']; ?>"></figure>
    <ul class="nlist">
      <p><?php echo $val['bloginfo_describe']; ?>...</p>
      <a title="/" href="<?php echo url('blog/index_content'); ?>?blog_id=<?php echo $val['bloginfo_id']; ?>" target="_blank" class="readmore">查看更多</a>
    </ul>
    <div class="line"></div>
    <?php endforeach; ?>
    <div class="blank"></div>
    <div style="margin:0px auto">
      <!-- <a title="Total record"><b>41</b></a><b>1</b><a href="/news/s/index_2.html">2</a><a href="/news/s/index_2.html">&gt;</a><a href="/news/s/index_2.html">&gt;&gt;</a> -->
    </div>
</div>
<aside class="right">
   <div class="rnav">
    <h3>
      <p>分类展示</p>
    </h3>
      <ul>
      <?php foreach($list['class_list'] as $val): ?>
       <li class="rnav1"><a href="<?php echo url('blog/index_class'); ?>?class_id=<?php echo $val['class_id']; ?>" target="_blank"><?php echo $val['class_title']; ?></a></li>
       <?php endforeach; ?>
     </ul>
    </div>
    <div class="cloud">
      <h3>标签</h3>
      <ul>
      <?php foreach($list['label_list'] as $val): ?>
        <li><a href="<?php echo url('blog/index_label'); ?>?label_id=<?php echo $val['label_id']; ?>"><?php echo $val['label_title']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    </div>
     <div class="news">
    <h3>
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="rank">
    <?php foreach($list['right_list']['blog_clicknum'] as $val): ?>
      <li><a href="<?php echo url('blog/index_content'); ?>?blog_id=<?php echo $val['bloginfo_id']; ?>" target="_blank"><?php echo $val['bloginfo_title']; ?>(<?php echo $val['bloginfo_click']; ?>)</a></li>
    <?php endforeach; ?>
    </ul>
    <h3 class="ph">
      <p>最新<span>发布</span></p>
    </h3>
    <ul class="paih">
    <?php foreach($list['right_list']['blog_latest_publish'] as $val): ?>
      <li><a href="<?php echo url('blog/index_content'); ?>?blog_id=<?php echo $val['bloginfo_id']; ?>" target="_blank"><?php echo $val['bloginfo_title']; ?></a></li>
    <?php endforeach; ?>
    </ul>
    </div>
    <div class="cloud">
      <h3>导航</h3>
      <ul>
      <?php foreach($list['right_list']['link_clicknum'] as $val): ?>
        <li><a href="<?php echo url('link/click_num'); ?>?url=<?php echo $val['link_url']; ?>&id=<?php echo $val['link_id']; ?>"><?php echo $val['link_title']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    </div>
    <div class="visitors">
      <h3><p>访问量</p></h3>
      <ul>

      </ul>
    </div>
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a>
    </div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
    <!-- Baidu Button END -->
</aside>
</article>

    
        <footer>
  <p>Design by NiuShao <a href="http://www.niushao.net/" target="_blank">Private Blog Web</a> <a href="/"></a></p>
</footer>
</body>
</html>
    
</body>
</html>