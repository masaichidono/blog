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
						<li class="active">新列表</li>
					</ol>
					<!--导航栏-->
					<ul class="nav nav-tabs">
					  <li role="presentation"><a href="<?php echo U('Admin/topicLists');?>">话题列表</a></li>
					  <li role="presentation" class="active"><a href="#">编辑话题</a></li>
					</ul>
					<!--话题表格-->
					
					<div class="content">
						<h3>编辑话题</h3>
						<div class="row">
							<div class="col-sm-6">
								<form action="<?php echo U('Admin/doEditTopic');?>" method="post">
								<div class="container-fluid" style="padding: 1rem;">
									<div class="form-group">
										<label for="exampleInputEmail1">话题标题</label>
		   							 	<input type="text" name="topic_title" class="form-control" id="topic_title" value="<?php echo ($data["title"]); ?>">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">话题内容</label>
		   							 	<textarea id="editor_id" name="topic_content" style="width:700px;height:300px;">
											<?php echo ($data["content"]); ?>
										</textarea>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">帖子标签</label>
		   							 	<input type="text" name="topic_tag" class="form-control" id="exampleInputEmail1" value="<?php echo ($data["tag"]); ?>">
										<span class="help-block">多个标签使用，分割，一次最多输入5个</span>
									</div>
									<div class="form-group">
										<h4>板块</h4>
										<select name="type" >
											<?php if(is_array($typelist)): foreach($typelist as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>" <?php if($data['type_id']==$vo['name']){echo 'selected';} ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
									<input type="hidden" name="topic_id" id="" value="<?php echo ($data['_id']); ?>" />
									<div class="form-group">
										<span style="margin-right: 2rem;font-weight: bold;">是否可见:</span>
										<input type="radio" name="visible" id="" value="1"  <?php if($data['visible']==1){echo 'checked';} ?> />可见
										<input type="radio" name="visible" id="" value="0" <?php if($data['visible']==0){echo 'checked';} ?> />不可见
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
										<button class="btn btn-primary" type="submit">修改</button>
										<a href="<?php echo U('Index/topic_detail');?>" class="btn btn-primary">跳转</a>
									</div>
								</div>
							</form>
							</div>
						</div>
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