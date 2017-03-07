<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="UTF-8"><title></title></head><body>		../Public： 会被替换成当前项目的公共模板目录 通常是 /项目目录/Tpl/当前主题/Public/ 
		<br/>__TMPL__： 会替换成项目的模板目录 通常是 /项目目录/Tpl/当前主题/
		<br/>（注：为了部署安全考虑，../Public和__TMPL__不再建议使用）
		<br/>__PUBLIC__：会被替换成当前网站的公共目录 通常是 /Public/
		<br/>__ROOT__： 会替换成当前网站的地址（不含域名） 
		<br/>__APP__： 会替换成当前项目的URL地址 （不含域名）
		<br/>__GROUP__：会替换成当前分组的URL地址 （不含域名）
		<br/>__URL__： 会替换成当前模块的URL地址（不含域名）
		<br/>__ACTION__：会替换成当前操作的URL地址 （不含域名）
		<br/>__SELF__： 会替换成当前的页面URL
		<!--<i><?php echo (date("y-m-d h:m:s",$date)); ?></i>--><div><?php echo (testname($name)); ?></div><!--<?php echo Date('y-m-d h:m:s',time()); ?>--><form action="<?php echo U('index/addForm');?>" method="post"><input type="text" name="text"/><input type="submit" value="提交"/></form></body></html>