
$(function(){
	

	$("#test").click(function(){
		alert(APP);
		$.post(APP+"/index/getAjax",{id:1},function(data){
			$("#test_show").html(data);
		})
	})
	//register
	$('#register_sub_btn').click(function(){
		var result_Email=checkForm.reg("register_email","register_email_str","R#Email#4-30","邮箱");
		var result_Name=checkForm.reg("register_name","register_name_str","R#Username#0-20","昵称");
		var result_Password=checkForm.checkpwd("register_password1","register_password2","register_password1_str","register_password2_str","R##")
		if(result_Email&&result_Name&&result_Password){
			alert("submit ok");
			return;
		}
	})
	$("#widget_userinfo_test").click(function(){
		alert('a')
	})
	//发布新话题
	$("#comment_sub_btn").click(function(){
		var comment_content=$("#comment_content").val();
		var topic_id=$("#topic_id").val();
		//评论为空
		if(!comment_content){
			//checkForm 进行验证
			alert("评论不能为空，或者数据出现错误");
			return false;
		}
//		alert(APP+"Comment/addComment")
		//ajax
		$.post(APP+"/Comment/addComment",{comment_content:comment_content,topic_id:topic_id},function(msg){
			alert(msg)
			
			switch (msg){
				case "0": 
					alert("请登录后再评论");
					break;
				case "1":
					alert("评论成功");
					break;
				case "2":
					alert("你的评论被狗吃了")
					break;
			}
		})
		
	})
	//赞一下
	$(".digg_btn").click(function(){
		var comment_id=$(this).attr("comment_id")
		var uid=$(this).attr("uid")
		//因为在post的回掉函数里，$(this)已经发生变化，所以需要将$(this)搞成post回掉函数里也可以用的_this变量
		var _this=$(this);
		//判断赞 还是	取消赞
		var type=$(this).attr("type")
		if(type=="1"){   //赞
			$.post(APP+"/Digg/addDigg",
				{comment_id:comment_id},
				function(msg){
					switch(msg){
						case "0":
							alert("请登录后再赞");
							break;
						case "1":
							alert("点赞成功");
							//js改变，因为只是初始化得时候需要后台链接数据库，初始化之后都由js来进行表面值得加载
							_this.attr("type",0);
							_this.html("取消赞");
							var num=Number(_this.parent().find(".digg_num").html())+1;
							_this.prev().html(num)
							break;
						case "2":
							alert("出了点小小的错误");
							break;
					}
				}
			)
		}else{
			$.post(APP+"/Digg/cancelDigg",
			{comment_id:comment_id,uid:uid},
			function(msg){
				if(msg=="1"){
					alert('取消成功')
					//js改变，因为只是初始化得时候需要后台链接数据库，初始化之后都由js来进行表面值得加载
					_this.attr("type",1);
					_this.html("赞")
					var num=Number(_this.parent().find(".digg_num").html())-1;
					_this.parent().find(".digg_num").html(num)
				}else if(msg=="2"){
					alert("出了点小小得错误");
				}
			})
			
			
		}
	})
})