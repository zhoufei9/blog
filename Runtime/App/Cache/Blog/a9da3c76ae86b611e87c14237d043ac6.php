<?php if (!defined('THINK_PATH')) exit();?><div class="panel-body">
	<!--友情链接 图片链接-->
<?php if(count($list['picture']) != 0): ?><div class="flink_image">
            <?php if(is_array($list["picture"])): $i = 0; $__LIST__ = $list["picture"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$po): $mod = ($i % 2 );++$i;?><li><a target="_blank" title="<?php echo ($po["title"]); ?>" href="<?php echo ($po["link"]); ?>"><img src="<?php echo ($po["path"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</div><?php endif; ?>
</div>
<div class="panel-body">



<!--友情链接 文字链接-->
<?php if(count($list['writing']) != 0): if(is_array($list["writing"])): $i = 0; $__LIST__ = $list["writing"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lo): $mod = ($i % 2 );++$i;?><li><a target="_blank" title="<?php echo ($po["title"]); ?>" href="<?php echo ($lo["link"]); ?>"><?php echo ($lo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>