<?php if (!defined('THINK_PATH')) exit();?>
<span>
	<span class="digg_num"><?php echo ($diggs); ?></span>
	<!--因为赞按钮是很多的，所以不能用id，type是用来标记赞1，取消赞0-->
	<a href="javascript:;" class="digg_btn" type="<?php echo ($type); ?>" comment_id="<?php echo ($comment_id); ?>" uid="<?php echo ($uid); ?>"><?php echo ($text); ?></a>
</span>