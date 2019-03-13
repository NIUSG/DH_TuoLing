<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"/home/wwwroot/default/DH_TuoLing/item/public/../application/index/view/index/index.html";i:1552459632;s:75:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/base/base.html";i:1552459632;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/header.html";i:1552459632;s:79:"/home/wwwroot/default/DH_TuoLing/item/application/index/view/public/footer.html";i:1552459632;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>NiuShao Blog</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="keywords" content="NiuShao Blog" />
    <meta name="description" content="NiuShao Blog" />
    <link href="http://127.0.0.1/DH_TuoLing/item/public/static/IndexStyle/css/base.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://127.0.0.1/DH_TuoLing/item/public/static/IndexStyle/js/modernizr.js"></script>
    <![endif]-->
    
    <link href="http://127.0.0.1/DH_TuoLing/item/public/static/IndexStyle/css/index.css" rel="stylesheet">

    <script src="http://127.0.0.1/DH_TuoLing/item/public/static/IndexStyle/js/silder.js"></script>
    

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
    
    

<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>Smile, breathe, and go slowly. - Thich Nhat Hanh</p>
      <p>Simplicity is the essence of happiness. - Cedric Bledsoe</p>
      <p>When there is no desire, all things are at peace. - Laozi</p>
    </ul>
    <div class="avatar"><a href="#"><span>ÑîÇà</span></a> </div>
  </section>
</div>

<!--
<div class="template">
  <div class="box">
    <h3>
      <p><span>¸öÈË²©¿Í</span>Ä£°å Templates</p>
    </h3>
    <ul>
      <li><a href="/"  target="_blank"><img src="images/01.jpg"></a><span>·ÂÐÂÀË²©¿Í·ç¸ñ¡¤Ã·¡ª¡ª¹Åµä¸öÈË²©¿ÍÄ£°å</span></li>
      <li><a href="/" target="_blank"><img src="images/02.jpg"></a><span>ºÚÉ«ÖÊ¸ÐÊ±¼äÖáhtml5¸öÈË²©¿ÍÄ£°å</span></li>
      <li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>GreenÂÌÉ«Ð¡ÇåÐÂµÄÏÄÌì-¸öÈË²©¿ÍÄ£°å</span></li>
      <li><a href="/" target="_blank"><img src="images/04.jpg"></a><span>Å®ÉúÇåÐÂ¸öÈË²©¿ÍÍøÕ¾Ä£°å</span></li>
      <li><a href="/"  target="_blank"><img src="images/02.jpg"></a><span>ºÚÉ«ÖÊ¸ÐÊ±¼äÖáhtml5¸öÈË²©¿ÍÄ£°å</span></li>
      <li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>GreenÂÌÉ«Ð¡ÇåÐÂµÄÏÄÌì-¸öÈË²©¿ÍÄ£°å</span></li>
    </ul>
  </div>
</div>
-->
<article>
  <h2 class="title_tj">
    <p>首页<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    <?php foreach($list['index_blog_list'] as $val): ?>
    <h3><?php echo $val['bloginfo_title']; ?></h3>
    <figure><img src="http://127.0.0.1/DH_TuoLing/item/public/uploads/BlogsImg/<?php echo $val['bloginfo_img']; ?>"></figure>
    <ul>
      <p><?php echo $val['bloginfo_describe']; ?>...</p>
      <a title="/" href="<?php echo url('blog/index_content'); ?>?blog_id=<?php echo $val['bloginfo_id']; ?>" target="_blank" class="readmore">查看更多</a>
    </ul>
    <p class="dateview"><span><?php echo $val['created_at']; ?></span><span></span><span>文章类别[<a href="/news/life/"><?php echo $val['class_title']; ?></a>]</span></p>
    <?php endforeach; ?>
  </div>
<!--==============================右边栏目================================-->
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
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
        <li><a href="<?php echo url('link/click_num'); ?>?url=<?php echo $val['link_url']; ?>&id=<?php echo $val['link_id']; ?>"><?php echo $val['link_title']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    </div>
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
    <!-- Baidu Button END -->
</article>

    
        <footer>
  <p>Design by NiuShao <a href="http://www.niushao.net/" target="_blank">Private Blog Web</a> <a href="/"></a></p>
</footer>
</body>
</html>
    
</body>
</html>