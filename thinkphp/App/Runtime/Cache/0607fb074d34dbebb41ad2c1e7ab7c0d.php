<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.underline{
		/*padding: 1rem 0;*/
		border-bottom: 2px solid #CCCCCC;
	}
	.line{
		height: 2rem;
		background-color: #dbdbdb;
	}
</style>
<div class="container-fluid" style="padding: 2rem;">
	<div class="row">
		<img src="" alt="" width="80" height="80" class="col-sm-4" />
		<div style="float: left;" class="col-sm-8" id="xinxi">
			<a href="#"><?php echo ($name); ?></a>
			<p>积分:123</p>
		</div>
	</div>
	<div class="underline"></div>
	<h5>个人简介:</h5>
	<div class="underline"></div>
	<button class="btn col-sm-12" style="background-color: #ccc;">个人信息通知</button>
</div>
<div class="line"></div>