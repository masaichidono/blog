
//本js文件主要是输入框验证的集合
var checkForm={
	Email    : /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
		Phone    : /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/,
		Mobile   : /^((\(\d{2,3}\))|(\d{3}\-))?13\d{9}$/,
		Url      : /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
		Currency : /^\d+(\.\d+)?$/,
		Number   : /^\d+$/,
		Zip      : /^[1-9]\d{5}$/,
		QQ       : /^[1-9]\d{4,8}$/,
		Integer : /^[-\+]?\d+$/,
		Double   : /^[-\+]?\d+(\.\d+)?$/,
		English : /^[A-Za-z]+$/,
		Chinese : /^[\u0391-\uFFE5]+$/,
		Username : /^[a-zA-Z]\w{3,}$/i,
		/*
		 * 验证规则 非空，长度 正则
		 * id 要进行验证的表单对象，input type-text username
		 * out_id 你要显示信息的element元素
		 * f 如何验证的规则  是否不能为空#Email#长度区间
		 * m 提示信息 4-6
		 */
	checkpwd:function(pwd1,pwd2,out_id1,out_id2,f){
		var val1=$("#"+pwd1).val()
		var val2=$("#"+pwd2).val()
		
		var r1=this.reg(pwd1,out_id1,f,"密码")
		var r2=this.reg(pwd2,out_id2,f,"密码")
		

		if(val1!=val2){
			$("#"+out_id2).html("两次密码输入不一致").css("color","red");
			return false;
		}
		if(r1&&r2){
			return true;
		}else{
			return false
		}
	},
	reg:function(id,out_id,f,name,m){
		var val =$("#"+id).val();
		var r =f.split("#")[0];
		//当需要验证输入不能为空时 非空验证
		if(r){
			if(!val){
				$("#"+out_id).html(name+"不能为空").css("color","red");
				return false;
			}
			$("#"+out_id).html(name+"格式正确").css("color","green");
		}
		//长度验证
		
		var len=f.split("#")[2];
		if(len){
			var start_len=len.split("-")[0]
			var end_len=len.split('-')[1]
			if(val.length<start_len||val.length>end_len){
				$("#"+out_id).html(name+"长度超出"+len+"范围").css("color","red");
				return false;
			}
			$("#"+out_id).html(name+"格式正确").css("color","green");
		}
		//格式验证
		var reg=f.split("#")[1]
		if(reg){
			var regs=this[reg];  //不能使用this.reg寻找
			if(!regs.test(val)){
				$("#"+out_id).html(name+"格式错误").css("color","red");
				return false;
			}
			$("#"+out_id).html(name+"格式正确").css("color","green");
		}
		
		return true;
	}
}
