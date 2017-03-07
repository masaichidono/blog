<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>PHP社区</title>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap-theme.css"/>
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
		<header role="banner">
			
		<!--头部导航栏-->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			     	 </button>
					<a class="navbar-brand" href="<?php echo U('Index/index');?>">PHP社区</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-collapse">
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
		</head>
		<!--内容-->
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content">
						<h3>用户注册</h3>
						<form class="form-horizontal col-sm-offset-1" role="form" method="post" action="<?php echo U('User/doRegister');?>">
							<!--<fieldset>-->
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label">用户名</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" id="register_name" name="uname" placeholder="用户名">
						      <span class="help-block" id="register_name_str">请输入你要注册的用户名</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
						    <div class="col-sm-6">
						      <input type="email" class="form-control" id="register_email" name="email" placeholder="Email">
						      <span class="help-block" id="register_email_str">email</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3"  class="col-sm-3 control-label">密码</label>
						    <div class="col-sm-6">
						      <input type="password" class="form-control" id="register_password1" name="password" placeholder="密码">
						      <span class="help-block" id="register_password1_str">请输入你的密码</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword4"  class="col-md-3 control-label">请再次输入密码</label>
						    <div class="col-md-6">
						      <input type="password"  name="password1" class="form-control" id="register_password2" placeholder="密码">
						      <span class="help-block" id="register_password2_str">请再次输入你的密码</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-3 col-sm-8">
						      <button class="btn btn-info" id="register_sub_btn" type="submit">快速注册</button>
						      <button class="btn btn-primary">返回登录</button>
						    </div>
						    
						  </div>
						  <!--</fieldset>-->
						</form>
						<!--其他-->
						<div class="content-others">
							<h4>热门话题</h4>
							<ul>
								<li><a href="#">如何搭建linux服务器</a></li>
								<li><a href="#">如何搭建linux服务器</a></li>
								<li><a href="#">如何搭建linux服务器</a></li>
								<li><a href="#">如何搭建linux服务器</a></li>
								<li><a href="#">如何搭建linux服务器</a></li>
							</ul>
						</div>
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