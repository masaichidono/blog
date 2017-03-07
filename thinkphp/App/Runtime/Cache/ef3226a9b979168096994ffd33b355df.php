<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>PHP社区</title>
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
					<a class="navbar-brand" href="<?php echo U('Index/index');?>">PHP社区</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="#">主页</a>
						</li>
						<li>
							<a href="#">分类模板</a>
						</li>
						<li>
							<a href="#">社区主页</a>
						</li>
						<li>
							<a href="#">关于我们</a>
						</li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">搜索</button>
						<a href="<?php echo U('Index/addTopic');?>" class="btn btn-primary">发布新话题</a>
					</form>
					<!--未登录时的按钮-->
					<?php if($_SESSION['isLogin']!=1){ ?>
					<div class="btn-group pull-right">
						<a href="<?php echo U('User/login');?>" class="btn btn-default">登录</a>
						<a href="<?php echo U('User/register');?>" class="btn btn-default">注册</a>
					</div>
					<?php }else{ ?>
					<!--登录后的按钮-->
					<div class="btn-group pull-right">
					 	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						   <?php echo ($_SESSION['userinfo']); ?><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">个人主页</a></li>
						   <li><a href="<?php echo U('User/changepwd');?>">个人设置</a></li>
						   <li><a href="#">我的话题</a></li>
						   <li><a href="#">我的回复</a></li>
						   <li><a href="#">记事本</a></li>
						</ul>
						<a href="<?php echo U('User/logout');?>" class="btn" style="color:white;">退出</a>
					</div>
					<?php } ?>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
<!--内容-->
<style type="text/css">
	
</style>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content container-fluid">
						<h3>修改用户密码</h3>
						<ul class="nav nav-tabs">
						  <li role="presentation"><a href="#">基本设置</a></li>
						  <li role="presentation" class="active"><a href="<?php echo U('User/changeavater');?>">头像设置</a></li>
						  <li role="presentation"><a href="#">修改密码</a></li>
						</ul>
						<h4>当前头像</h4>
						<div class="container-fluid col-sm-offset-4" style="margin-bottom: 2rem;">
							<img src="__ROOT__/Upload/thumb_<?php echo ($info["avatar"]); ?>" class="img-rounded" width="150" height="150"/>
							<img src="__ROOT__/Upload/thumb_<?php echo ($info["avatar"]); ?>" class="img-rounded" width="100" height="100"/>
						</div>	
							<form action="<?php echo U('User/uploadAvatar');?>" method="post" class="col-sm-offset-4" enctype="multipart/form-data">
								<span>选择</span>
								<input type="file" name="icon" id="" value="选择文件" style="display: inline-block;margin-bottom: 1rem;"/>
								<button type="submit" style="display: block;" class="btn btn-primary">确认</btton>
							</form>
					</div>
				</div>
				<div class="col-md-4">
					<div class="content">
						
					</div>
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