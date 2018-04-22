<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>simpleAce后台管理</title>
        <meta name="description" content="simpleAce">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


        <!-- CSS Core -->
<link rel="shortcut icon" href="/Public/admin/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="/Public/admin/css/app.css">
        <link id="layout-theme" rel="stylesheet" type="text/css" href="/Public/admin/css/default.min.css">
        <!-- JS -->
      <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>

</head>
<body class="fixed-sidebar fixed-header">



<div id="page-wrapper" class="demo-example">

<div id="page-sidebar">
<div id="header-logo">
                   

                    <a href="javascript:;" class="tooltip-button" data-placement="bottom" title="Close sidebar" id="close-sidebar">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" data-placement="bottom" title="Open sidebar" id="rm-close-sidebar">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" title="Navigation Menu" id="responsive-open-menu">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
</div>

                <div id="sidebar-menu" class="scrollable-content">
                    <ul>
                        <li>
                            <a href="<?php echo U('Admin/Index/index');?>"  title="Dashboard">
                                <i class="glyph-icon icon-dashboard"></i>
                                后台首页
                            </a>
                        </li>
                                 <?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="sub-menu">
                      <a href="javascript:;" >
                      <i class="glyph-icon <?php echo ($vo['icon']); ?>"></i>
                          
                          <span> <?php echo ($vo["title"]); ?></span>
                      </a>
                     
                      <ul class="sub">
                       <?php if(is_array($menu[$vo['id']])): $i = 0; $__LIST__ = $menu[$vo['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosub): $mod = ($i % 2 );++$i;?><li>
                          <?php if($vosub['hassub'] == 1): ?><a href="javascript:void(0);"  zs-id="<?php echo ($vosub['id']); ?>" ><i class="glyph-icon <?php echo ($vosub['icon']); ?>"></i><?php echo ($vosub["title"]); ?></a>                        
                          
                           <ul class="sub mrg10A">
                           <?php if(is_array($vosub['sub'])): $i = 0; $__LIST__ = $vosub['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosubsub): $mod = ($i % 2 );++$i;?><li><a  href="<?php echo ($vosubsub['url']); ?>" rel="<?php echo ($vosubsub['rel']); ?>"  zs-id="<?php echo ($vosubsub['id']); ?>"><i class="glyph-icon icon-chevron-right"></i><?php echo ($vosubsub["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>    
                            </ul>
                          <?php else: ?>
                          <a href="<?php echo ($vosub['url']); ?>" rel="<?php echo ($vosub['rel']); ?>"  zs-id="<?php echo ($vosub['id']); ?>"><i class="glyph-icon  <?php echo ($vosub['icon']); ?>"></i><?php echo ($vosub["title"]); ?></a><?php endif; ?>

                         
                          
                          
                          </li><?php endforeach; endif; else: echo "" ;endif; ?>
                         
                      </ul>
                     
                  </li><?php endforeach; endif; else: echo "" ;endif; ?>
                       
                       
                    </ul>
                    
        
                </div>

            </div><!-- #page-sidebar -->

<div id="page-main">
<div id="page-main-wrapper">

                   <div id="page-header" class="clearfix">
                        <div id="page-header-wrapper" class="clearfix">
                            
                            
                            
                            
                            <div class="top-icon-bar dropdown">
                                <a href="javascript:;" title="" class="user-ico clearfix" data-toggle="dropdown">
                                    <img width="36" src="<?php echo ($userinfo['avatar64']); ?>" alt="<?php echo ($userinfo["nickname"]); ?>">
                                    <span><?php echo ($userinfo["nickname"]); ?></span>
                                    <i class="glyph-icon icon-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu float-right">
                                    
                                    <li>
                                        <a href="<?php echo U('Public/password');?>"  width="460px" height="280px" target=dialog title="修改密码">
                                            <i class="glyph-icon icon-cog mrg5R"></i>
                                            修改密码
                                        </a>
                                    </li>
                                    <li>
                                        <a class="font-orange" href="/index.php?m=Blog&c=Index" title="" target='_blank'>
                                            <i class="glyph-icon icon-flag mrg5R"></i>
                                            前往博客主页
                                        </a>
                                    </li>
                                   
                                    <li class="divider"></li>
                                     <li>
                                        <a href="<?php echo U('Public/logout');?>" target="AjaxTodo" title="你确定要退出后台管理吗？">
                                        
                                            <i class="glyph-icon icon-sign-out font-size-13 mrg5R"></i>
                                            <span class="font-bold">退出</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="top-icon-bar">
                               <a href="<?php echo U('Public/cleancache');?>" target="AjaxTodo" >
                                   
                                     <i class="glyph-icon icon-wrench"></i>
                                     清理缓存
                                   
                                </a>
                                
                            </div>
                            

                            

                        </div>
                    </div><!-- #page-header -->

<div id="page-breadcrumb-wrapper">


<div id="page-breadcrumb">
                            <a href="<?php echo ($breadcrumb['purl']); ?>" id="parentname" title="<?php echo ($breadcrumb['pname']); ?>">
                                <i class="glyph-icon icon-dashboard"></i>
                                <?php echo ($breadcrumb['pname']); ?>
                            </a>
                           
                            <span class="current" id="activeaname">
                                <?php echo ($breadcrumb['localname']); ?>
                            </span>
                        </div>
                        
                     


    </div><!-- #page-breadcrumb-wrapper -->

<div id="page-content">

<div class="example-code">

        <a href="<?php echo U('add');?>" rel="articleadd"  title="新增资讯"  class="btn bg-green medium"> <span class="button-content">
                <i class="glyph-icon icon-plus"></i> 新增
                </span></a>
         <a href="<?php echo U('position');?>" class="btn bg-red medium"  target="checkedAjaxTodo" idname="ids"> <span class="button-content">
                <i class="glyph-icon icon-star"></i> 推荐
                </span></a>
         <a href="<?php echo U('zhiding');?>" class="btn bg-red medium"  target="checkedAjaxTodo" idname="ids"> <span class="button-content">
                <i class="glyph-icon icon-angle-double-up"></i> 置顶
                </span></a>
         <a href="<?php echo U('qxposition');?>" class="btn bg-red medium"  target="checkedAjaxTodo" idname="ids"> <span class="button-content">
                <i class="glyph-icon icon-star-o"></i> 取消推荐与置顶
                </span></a>

                         <div class="dropdown float-right mrg15R">
                                <a href="javascript:;" class="btn medium bg-blue" title="Example dropdown" data-toggle="dropdown">
                                    <span class="button-content">
                                        <i class="glyph-icon icon-cog float-left"></i>
                                        
                                        批量操作
                                        
                                        <i class="glyph-icon icon-caret-down float-right"></i>
                                    </span>
                                </a>
                               
                                <ul class="dropdown-menu float-right">
                                    
                                     <li class="hidden">
                                        <a href="/index.php/Admin/Article/outxls/ids/all" target="dwzExport">
                                            <i class="glyph-icon icon-sign-out font-size-13 mrg5R"></i>
                                            <span class="font-bold">导出全部</span>
                                        </a>
                                    </li>
                                     <li class="hidden">
                                        <a href="/index.php/Admin/Article/outxls" target="checkedExport" idname="ids">
                                            <i class="glyph-icon icon-sign-out font-size-13 mrg5R"></i>
                                            <span class="font-bold">导出选中</span>
                                        </a>
                                    </li>
                                   
                                   
                                    <li class="divider hidden"></li>
                                    <li>
                                        <a class="font-orange" href="<?php echo U('selectedDelete');?>"  title="确定要删除选中信息吗？" target="checkedAjaxTodo" idname="ids">
                                            <i class="glyph-icon icon-trash-o"></i>
                                            删除选中
                                        </a>
                                    </li>
                                </ul>
                            </div>
</div>
  <div class="divider"></div>
  <table class="table text-left"  id="zstable">
        <thead>
            <tr>
                <th width="40">ID</th>
                <th>分类</th>
                <th>文章发布者</th>
                 <th class="orderby <?php if(($order) == "title"): echo ($sortImg); endif; ?>" orderField="title">标题</th>
                <th  width="120" class="orderby <?php if(($order) == "status"): echo ($sortImg); endif; ?>" orderField="status">资讯状态</th>
                <th  width="120" class="orderby <?php if(($order) == "tj"): echo ($sortImg); endif; ?>" orderField="tj">推荐</th>
                 <th class="nosort" width="30"><input type="checkbox" class="checkboxCtrl j-icheck" group="ids"></th>
                <th class="nosort text-center" width="200">操作</th>
            </tr>
        </thead>
        <tbody>
           <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($key+1); ?></td>
                <td><a href="/index.php?m=Blog&c=Index&a=artlist&cid=<?php echo ($vo["cid"]); ?>" target="_blank"><?php echo (get_cate($vo["cid"],'name')); ?></a></td>
                <td><?php echo (get_username($vo["uid"])); ?></td>
				<td><a href="/index.php?m=Blog&c=Index&a=artc&id=<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></td>
				<td><?php echo (getStatus($vo['status'])); ?></td>
				<td><?php echo (getPosition($vo['tj'])); ?></td>
				<td><input type="checkbox" name="ids" class="j-icheck" value="<?php echo ($vo['id']); ?>"></td>
				<td>
                    <a href="<?php echo U('edit',array('id'=>$vo['id']));?>" rel="articleedit<?php echo ($vo["id"]); ?>"  class="btn small bg-blue" title="编辑<?php echo ($vo["title"]); ?>" ><span class="button-content"><i class="glyph-icon icon-edit"></i> 编辑</span></a>
                   <?php echo (showStatus($vo['status'],$vo['id'],CONTROLLER_NAME)); ?>
                    <a href="<?php echo U('foreverdelete',array('id'=>$vo['id']));?>" class="btn small bg-red" target="ajaxTodo" title="确定要删除该行信息吗？"><span class="button-content"><i class="glyph-icon icon-trash-o"></i> 删除</span></a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>


	</div><!-- #page-content -->
                


</div><!-- #page-main -->
</div><!-- #page-main-wrapper -->
</div><!-- #page-wrapper -->







  
        <!--[if lt IE 9]>
          <script src="/Public/static/html5.js"></script>
          <script src="/Public/static/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/static/uploadify/uploadify.css"> 
        <script type="text/javascript" src="/Public/static/layer/layeradmin.js"></script>
         <script type="text/javascript" src="/Public/static/kindeditor/kindeditor-all.js"></script>
         <script type="text/javascript" src="/Public/admin/js/app.js"></script>
         <script type="text/javascript" src="/Public/admin/js/core.js"></script>
    

<script type="text/javascript">

var _STATIC_ = "/Public/static";
var _APP_="/index.php";
var _PUBLIC_="/Public";
$(function(){
	initUI();
});

</script>
<script>

	
	setactive("<?php echo ($breadcrumb['id']); ?>");



</script>






</body>
</html>