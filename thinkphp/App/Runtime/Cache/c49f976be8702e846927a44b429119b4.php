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
					<div class="content">
						<h3>修改用户密码</h3>
						<ul class="nav nav-tabs">
						  <li role="presentation"><a href="#">基本设置</a></li>
						  <li role="presentation"><a href="<?php echo U('User/changeavater');?>">头像设置</a></li>
						  <li role="presentation" class="active"><a href="#">修改密码</a></li>
						</ul>
						<!--修改密码面板-->
						<form class="form-horizontal" style="margin-top: 5rem;" method="post" action="<?php echo U('User/doChangepwd');?>">
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 col-lg-offset-2 control-label">原密码</label>
						    <div class="col-sm-4">
						      <input type="password" name="oldpwd"  class="form-control" id="inputEmail3" placeholder="请输入您当前的密码">
						       <span class="help-block">请输入你的密码</span>
						    </div>
						  </div>
						  
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 col-lg-offset-2 control-label">新密码</label>
						    <div class="col-sm-4">
						      <input type="password"  name="newpwd" class="form-control" id="inputPassword3" placeholder="请输入您的新密码">
						      <span class="help-block">请输入新密码</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 col-lg-offset-2 control-label">再次输入</label>
						    <div class="col-sm-4">
						      <input type="password" name="newpwd1" class="form-control" id="inputPassword3" placeholder="再次输入新密码">
						      <span class="help-block">请再次输入你的密码</span>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 col-lg-offset-2 control-label">验证码</label>
						    
						      <img src="__APP__/User/vertify" style="float: left;padding: 6px 0px;" onclick="changeVertify(this)"/>
						      <script type="text/javascript">
						      	function changeVertify(obj){
//						      		obj.src="<?php echo U('User/vertify/"+new Date().getTime()+"');?>";
									obj.src="__APP__/User/vertify/"+ new Date().getTime()
									//添加时间戳是使浏览器每次缓存不保存
						      	}
						      </script>
						      <div class="col-sm-4">
						      <input type="text" name="vertify" class="form-control" value="<?php echo ($ver); ?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 col-lg-offset-2 control-label">提交</label>
						    <div class="col-sm-4">
						      <button class="btn btn-primary" type="submit">确认修改</button>
						    </div>
						  </div>
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