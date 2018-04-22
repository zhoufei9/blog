<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo ($webdescription); if($webdescription != ''): ?>|<?php endif; echo C('WEB_SITE_DESCRIPTION');?>" />
<meta name="keywords" content="<?php echo ($webkeyword); if($webkeyword != ''): ?>|<?php endif; echo C('WEB_SITE_KEYWORD');?>" />
<meta name="robots" content="all" />
<meta name="author" content="www.51cgw.cn" />

<title><?php echo C('WEB_SITE_TITLE');?></title>

<link href="/Public/static/style/style.css" rel="stylesheet" media="screen" type="text/css" />

<style>
html{
	scrollbar-face-color:#c8c8c8;
	scrollbar-highlight-color:#c8c8c8;
	scrollbar-shadow-color:#fff;
	scrollbar-3dlight-color:#fff;
	scrollbar-arrow-color:#fff;
	scrollbar-track-color:#EAEAEA;
	scrollbar-darkshadow-color:#c8c8c8;
}
</style>

</head>
<body>
<!--[if lte IE 7]>
<style type="text/css">
#errorie {position: fixed; top: 0; z-index: 100000; height: 30px; background: #FCF8E3;}
#errorie div {width: 900px; margin: 0 auto; line-height: 30px; color: orange; font-size: 14px; text-align: center;}
#errorie div a {color: #459f79;font-size: 14px;}
#errorie div a:hover {text-decoration: underline;}
</style>
<div id="errorie"><div>您还在使用老掉牙的IE，请升级您的浏览器到 IE8以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
<![endif]-->
<a name="gettop" id="gettop"></a>
<div id="header">
	<div id="nav">
		<div id="navBar">
		  <div id="navMenu">
		  	<ul>
      	<li><a href="/index.php?m=Blog&c=Index" title="<?php echo C('WEB_SITE_TITLE');?>"><span><?php echo C('WEB_SITE_TITLE');?></span></a></li>
		<li><a target="_self" href="/index.php?m=Blog&c=Index&a=artlist&cid=4"><span>日志</span></a></li>
		<li><a target="_self" href="/index.php?m=Blog&c=about"><span>关于</span></a></li>
		<li><a target="_self" href="/index.php?m=Blog&c=guestbook"><span>留言</span></a></li>
    	</ul>
		  </div>
		  <div id="navLink">
		    <ul>
          <li><a href="http://weibo.com/u/3337501084" target="_blank"><img src="/Public/static/images/navLink/icon-tsina.gif" alt="新浪微博 求围观!" title="新浪微博 求围观!" width="21" height="21" /></a></li>
        </ul>
		  </div>
	  </div>
	</div>
	<div id="sub">
		<div id="subLogo">
		</div>
		<div id="subTitle">
			<h1>再次起飞Z°</h1>
			<h4>  不误 ｜ 不痴 ｜ 不急 ｜ 不噪  </h4>
		</div>
	</div>
</div><!-- //End header -->


<!-- /header -->


<div id="container">

<div id="main">

	<div id="place">
		<strong>欢迎来到阿飞的个人博客，希望能给你带来欢乐！</strong>
	</div>
	<br/>
<?php $map=array('0','true','0','1','tj desc,id desc','','10','','','','','',);$data = callApi("Art/getArt",$map);$__LIST__ = $data['data']; if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="listArticle">

		<div class="listtitle">
		  	<h3><a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></a></h3>
		</div>

		<span class="info">
		  <small>日期：<?php echo (friendlyDate($vo["create_time"])); ?></small>&nbsp;｜&nbsp;
		  <small>分类：<a href="/index.php?m=Blog&c=Index&a=artlist&cid=<?php echo ($vo["cid"]); ?>"><?php echo (get_cate_nameByid($vo["cid"])); ?></a></small>&nbsp;｜&nbsp;
			<small>标签：</small><?php echo ($vo["linktag"]); ?>&nbsp;｜&nbsp;
			<small> <?php echo ($vo["reply_count"]); ?> Comments</small>
		</span>
		<?php if($vo['img']): ?><div class="preview">
			<a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>">
<img src="<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" height="146" width="220"></a>
		</div><?php endif; ?>
		<p class="intro">
			<?php echo (cutstr_html(op_t($vo["description"]),150)); ?>
		</p>

		<p class="readMore">
			<a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>">阅读剩余部分...</a>
		</p>

	</div><?php endforeach; endif; else: echo "" ;endif; ?>


    <div class="pages">
				<ul>
          <a href="/index.php?m=Blog&c=Index&a=artlist&cid=1"><<&nbsp;较早以前的文章</a>
			  </ul>
		</div><!-- /pages -->


</div>


<div id="sidebar">
	<div id="ad_1">
  	<a href="#"><img src="/Public/static/images/ad-1.jpg" alt="请爱护地球的每一花一叶！！" title="请爱护地球的每一花一叶！"/></a>
  </div>
  
  <div id="sideLine"></div>
  
  <div id="searchBox">
  	   <form action="/index.php?m=Blog&c=Index&a=search" class="form"  method="post" name="formsearch">
          <h4>搜索</h4>          
          <input name="keyword" type="text" class="searchbox" id="keyword"  value="<?php echo ($_REQUEST['keyword']); ?>" />         	  	
          <input name="submit" type="image" class="searchsubmit" src="/Public/static/images/search-btn.jpg" alt="点击搜索!" />	
       </form>
  </div>
  <div id="sideLine"></div>

  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>日志分类</h2>
  	</div>
  	<div class="boxContent">
	
  		<ul class="listTitle ico1">
  			<?php if(is_array($catelistarr)): $i = 0; $__LIST__ = $catelistarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/index.php?m=Blog&c=Index&a=artlist&cid=<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
	  
  	</div>
  </div>
  
  <div id="sideLine"></div>
  
  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>热门日志</h2>
  	</div>
  	<div class="boxContent">
  		<ul class="listTitle">
      <!--最新文档-->
       <?php $map=array('0','true','0','1','view desc','','5','','','','true','',);$data = callApi("Art/getArt",$map);$__LIST__ = $data['data']; if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>">
<?php echo (cutstr_html($vo["title"],20)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      <!--//最新文档-->
      </ul>
  	</div>
  </div>
  
  <div id="sideLine"></div>

  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>最新日志</h2>
  	</div>
  	<div class="boxContent">
  		<ul class="listTitle">
      <!--最新文档-->
      <?php $map=array('0','true','0','1','view desc','','5','','','','true','',);$data = callApi("Art/getArt",$map);$__LIST__ = $data['data']; if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>">
<?php echo (cutstr_html($vo["title"],20)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      <!--//最新文档-->
      </ul>
  	</div>
  </div>
  
  <div id="sideLine"></div>  
  
  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>网友评论</h2>
  	</div>
  	<div class="boxContent">
  		<ul class="comments">
        <?php $map=array('0','true','0','1','reply_count desc','','7','','','','true','',);$data = callApi("Art/getArt",$map);$__LIST__ = $data['data']; if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id']!=1): ?></else><li> 
<a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>">
<?php echo (cutstr_html($vo["title"],20)); ?></a><span class="badge" title="<?php echo ($vo["reply_count"]); ?>条评论">（<?php echo ($vo["reply_count"]); ?>）</span> 
        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
  	</div>
  </div>
  
  <div id="sideLine"></div>
  
  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>标签云</h2>
  	</div>
  	 <div class="boxContent">
  	 	<div class="tag">
  	 		<ul>
<?php $map=array('num desc','','15','true','1',);$data = callApi("Tag/getTags",$map);$__LIST__ = $data['data']; if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key % 3 == 0 && $key>0) echo '</ul><ul>'; ?>
         <span ><a class="tag" href="/index.php?m=Blog&c=Index&a=tagart&id=<?php echo ($vo["id"]); ?>" <?php echo ($vo["tagcolor"]); ?>><?php echo ($vo["title"]); ?> </a></span><?php endforeach; endif; else: echo "" ;endif; ?>


		    </ul>
  	 	</div>
  	</div>
  </div>
  
  <div id="sideLine"></div>
  
  <div id="sidebarBox">
  	<div class="boxTop">
  		<h2>友情链接</h2>
  	</div>
  	<div class="boxContent">
  		<ul class="linksTxt">
			 <?php echo hook('friendLink');?>
		  </ul>
  	</div>
  </div>

</div>


</div>



<div class="clearfix"></div>  


<div id="footSub">
</div>

<div id="footNav">
	<h1><a href="http://www.51cgw.cn" target="_blank" title="再次起飞Z°
不误 ｜ 不痴 ｜ 不急 ｜ 不噪"><strong>再次起飞Z</strong></a>&nbsp;&copy; 2014 
<a href="http://51cgw.cn">51cgw</a> 版权所有 <?php echo C('WEB_SITE_ICP');?>
<?php echo hook('pageFooter');?>	<a href="/index.php?m=Blog&c=Sitemap" target="_blank">网站地图</a></h1>
</div>

<div id="go_top"><em></em><a href="#gettop">返回顶部</a></div>





<!-- /footer -->


</body>
</html>