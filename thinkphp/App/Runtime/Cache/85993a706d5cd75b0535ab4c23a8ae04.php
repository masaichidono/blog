<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>PHP社区后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/global.css"/>
	
		<style type="text/css">
			.btn-group{
				margin-top: 10px;
				color: black;
			}
			.btn-group a{
				color: black;
			}
		</style>
		
	</head>
	<script>
		var APP="__APP__";
	</script>
	<body>
		<!--头部导航栏-->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			     	 </button>
					<a class="navbar-brand" href="<?php echo U('Index/index');?>">PHP社区内容管理</a>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li <?php echo ($index); ?>>
							<a href="<?php echo U('Admin/index');?>">首页</a>
						</li>
						<li <?php echo ($topic); ?>>
							<a href="<?php echo U('Admin/topicLists');?>">话题管理</a>
						</li>
						<li >
							<a href="#">评论管理</a>
						</li>
						<li>
							<a href="#">用户管理</a>
						</li>
						<li>
							<a href="#">酷站管理</a>
						</li>
						<li>
							<a href="#">返回前台</a>
						</li>
					</ul>
					
					<!--未登录时的按钮-->
					<?php if($_SESSION['isLogin']!=1){ ?>
					<div class="btn-group pull-right">
						<a href="<?php echo U('User/login');?>" class="btn btn-default">登录</a>
						<a href="<?php echo U('User/register');?>" class="btn btn-default">注册</a>
					</div>
					<?php }else{ ?>
					<!--登录后的按钮-->
					<div class="btn-group pull-right">
					 	<button type="button" class="btn btn-default" data-toggle="dropdown">
						   <?php echo ($_SESSION['userinfo']); ?><span class="caret"></span>
						</button>
						<a href="<?php echo U('User/logout');?>" class="btn" style="color:white;">退出</a>
					</div>
					<?php } ?>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<!--内容-->
		<div class="container">
			<div class="row">
				<div class="content" style="padding:1rem;">
					<!--面包屑导航条-->
					<ol class="breadcrumb">
						<li>
							<a href="#">内容管理</a>
						</li>
						<li>
							<a href="#">话题管理</a>
						</li>
						<li class="active">话题列表</li>
					</ol>
					<!--导航栏-->
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#">话题列表</a></li>
					  <li role="presentation"><a href="#">话题分类</a></li>
					</ul>
					<!--话题表格-->
					<!--表格-->
					<table class="table table-hover" style="margin-top: 2rem;">
						<thead>
							<tr>
								<th>话题名称</th>
								<th>话题简介</th>
								<th>作者</th>
								<th>状态</th>
								<th>分类</th>
								<th>标签</th>
								<th>时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td><a href="#"><?php echo ($vo["title"]); ?></a></td>
									<td><?php echo ($vo["jianjie"]); ?></td>
									<td><?php echo ($vo["name"]["name"]); ?></td>
									<td><?php echo ($vo["status"]); ?></td>
									<td><?php echo ($vo["typename"]); ?></td>
									<td><?php echo ($vo["tag"]); ?></td>
									<td><?php echo (date("y-m-d h:m:s",$vo["created_date "])); ?></td>
									<td><?php echo ($vo["action"]); ?></td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<div><ul class="pagination"><?php echo ($pages); ?></ul></div>
				</div>
			</div>
		</div>
<!--底部-->
		<footer class="footer">
			<div class="container-fluid">
				<a href="#">意见反馈</a>
				<a href="#">关于我们</a>
				<p>&copy; masaichi</p>
			</div>
		</footer>
	</body>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/dev_main.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/checkForm.js"></script>
	
</html>