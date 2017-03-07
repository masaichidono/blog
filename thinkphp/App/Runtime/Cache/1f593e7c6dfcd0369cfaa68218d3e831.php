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
<style type="text/css">
	#xinxi>a{
		font-size: 20px;
		
	}
	#xinxi>span{
		font-size: 20px;
		display: block;
	}
	.underline{
		margin: 1rem 0;
		border-bottom: 2px solid #CCCCCC;
	}
	.line{
		height: 2rem;
		background-color: #dbdbdb;
	}
	.content{
		height: auto !important;
	}
</style>
		<!--内容-->
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content">
						<h3>发布新话题</h3>
						<form action="<?php echo U('Index/addNewTopic');?>" method="post">
							
							
						
						<div class="container-fluid" style="padding: 1rem;">
							<div class="form-group">
								<label for="exampleInputEmail1">话题标题</label>
   							 	<input type="text" name="topic_title" class="form-control" id="topic_title" >
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">话题内容</label>
   							 	<textarea id="editor_id" name="topic_content" style="width:700px;height:300px;">
									&lt;strong&gt;HTML内容&lt;/strong&gt;
								</textarea>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">帖子标签</label>
   							 	<input type="text" name="topic_tag" class="form-control" id="exampleInputEmail1" >
								<span class="help-block">多个标签使用，分割，一次最多输入5个</span>
							</div>
							<div class="form-group">
								<h4>板块</h4>
								<select name="type">
									<option value="0">请选择</option>
									<?php if(is_array($typelist)): foreach($typelist as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
							<!--验证码-->
							<div class="form-group">
								<h4>验证码</h4>
								<img src="__APP__/User/vertify" height="26" id="ma" onclick="clk(this)"/>
								<script type="text/javascript">
									function clk(obj){
										obj.src="__APP__/User/vertify/time"+new Date().getTime();	
									}
								</script>
								<input type="text" name="topic_vertify" id="" value="" />
								<button class="btn btn-primary" type="submit">发布新话题</button>
								<a href="<?php echo u('Index/topic_detail');?>" class="btn btn-primary">跳转</a>
							</div>
						</div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<div class="content" >
						<!--个人信息pane-->
						<div class="container-fluid" style="padding: 2rem;">
							<div class="row" >
								<img src="" alt="" width="80" height="80" class="col-sm-4"/>
								<div style="float: left;" class="col-sm-8" id="xinxi">
									<a href="#">123</a>
									<span>积分:123</span>
								</div>
							</div>
							<div class="underline"></div>
							<h5>个人简介:</h5>
							<div class="underline"></div>
							<button class="btn col-sm-12" style="background-color: #ccc;">个人信息通知</button>
							
						</div>
						<div class="line"></div>
							
						
					</div>
				</div>
			</div>
		</div>
		<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="__PUBLIC__/kindeditor/lang/zh-CN.js"></script>
		<script>
		        KindEditor.ready(function(K) {
		                window.editor = K.create('#editor_id');
		        });
		</script>
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