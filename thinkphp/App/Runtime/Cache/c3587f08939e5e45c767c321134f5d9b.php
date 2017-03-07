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
		padding: 1rem 0;
		border-bottom: 2px solid #CCCCCC;
	}
	.line{
		height: 2rem;
		background-color: #dbdbdb;
	}
	.content{
		height: auto !important;
	}
	
	.clearfix:before,.clearfix:after{
		content: "";
		display: block;
		clear: both;
	}
</style>
		<!--内容-->
		<div class="container">
			<ul class="breadcrumb">
                            <li><a href="#">首页</a> <span class="divider"></span></li>
                            <li><a href="#">php</a> <span class="divider"></span></li>
                            <li class="active">hello</li>
                        </ul>
			<div class="row">
				<div class="col-md-8">
					<div class="content container-fluid clearfix" style="padding: 1rem;">
						<h3 style="border:none;"><?php echo ($data['title']); ?></h3>
						
						<p>作者:<?php echo ($data['userinfo']['name']); ?>&nbsp;&nbsp;<?php echo ($data['typeinfo']['create_date']); ?>发布&nbsp;&nbsp;分类：<?php echo ($data['typeinfo']['name']); ?>&nbsp;&nbsp;<?php echo ($data['hits']); ?>阅读</p>
						<p class="underline">标签:
							<?php if(is_array($tag)): foreach($tag as $key=>$vo): ?><span style="margin: 0 1rem;"><?php echo ($vo); ?></span><?php endforeach; endif; ?>
						</p>
						<!--<h5 class="underline">标签:php</h5>-->
						<div class="detail_content" style="overflow: auto;"><?php echo ($data['content']); ?></div>
						<div class="underline"></div>
						<div>
							<h3>评论</h3>
							<textarea name="" rows="5" style="width: 100%;" id="comment_content"></textarea>
						</div>
						<input type="hidden" name="post_id" id="topic_id" value="<?php echo ($data["_id"]); ?>"/>
						<button class="btn btn-primary" id="comment_sub_btn">快速回复</button>
						<!--评论展示-->
						<?php if(is_array($commentlists)): foreach($commentlists as $key=>$vo): ?><div id="comment_info" style="padding: 1rem;">
								<div class="row">
									<a href="#" class="col-sm-1">
										<img src="__ROOT__/Uploads/{}" alt="" style="width: 64px;height: 64px;"/>
									</a>
									<div class="col-sm-10 " style="margin-left: 2rem;">
										<h5>[1]楼<a href="#">123</a></h5>
										<div>
											123
										</div>
										<div style='width:100%;text-align: right;'>发布于<?php echo (date("Y-m-d H:i:s",$vo["created_date"])); ?> <a href="javascript:;" class="show_textarea_btn" >回复</a>|<?php echo W('CommentDigg',array('comment_id'=>$vo['_id'],'uid'=>$vo['uid']));?>
										
										</div>
										<div style="display:none" class="reply_textarea"><textarea style="width:400px;"></textarea>
											<a href="javascript:;" class="btn btn-primary reply_comment" p_id="<?php echo ($data["_id"]); ?>" mid="<?php echo (session('mid')); ?>" comment_id="<?php echo ($vo["_id"]); ?>" uname="<?php echo ($vo["userinfo"]["uname"]); ?>" uid="<?php echo ($vo["uid"]); ?>">回复</a>
										</div>
									</div>
								</div>
							</div><?php endforeach; endif; ?>
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
									<span >积分:123</span>
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