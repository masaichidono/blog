<?php
	class UserAction extends Action{
		private $username=null;
		private $userId=null;
		protected function _initialize(){
//			初始化经常使用的变量和方法
			$this->username="masaichi";
			$this->userId=1;
		}
		public function index(){
			echo "用户控制器执行成功";
		}
		public function login(){
			$this->display('login');
		}
		public function doLogin(){
			if($_POST){
				$log['name']=$_POST['name'];
				$log['password']=md5($_POST['password']);
				$user=new MongoModel("user");
				$re=$user->where($log)->find();
				if($re){
					$_SESSION['isLogin']=1;
					$_SESSION['mid']=$re['_id'];
					$_SESSION['userinfo']=$log['name'];
					
					$this->success("登录成功",U("Index/index"));
				}else{
					$this->error("登录失败,用户不存在");
				}
				
			}else{
				$this->error("登录系统出现问题");
			}

		}
//		新用户注册界面
		public function register(){
			$this->display("register");
		}
		public function doRegister(){
//			dump($_POST['uname']);
			if($_POST['uname']){
				//验证用户名是否已经注册
				$user=new MongoModel('user');
				$re=$user->where(array('name'=>$_POST['uname']))->find();
				if($re!=NULL){
					$this->error("当前用户名已被注册");
					return false;
				}
				$data['name']=$_POST['uname'];
				$data['email']=$_POST['email'];
				$data['password']=md5($_POST['password']);
				$data['description']="";
				$data['status']=0;
				$data['ctime']=time();
				$data['ip']=get_client_ip();
				
				$per=new MongoModel("permission");
				$temp=$per->where(array('name'=>"admin","type"=>"login"))->find();
				if($temp){
					$data['permission']=array($temp['_id']);
				}else{
					$this->error("权限数据库出错");
				}
				
				$re=$user->add($data);
				if($re){
					//自动登录操作
					$_SESSION['isLogin']=1;
					$_SESSION['mid']=$re;
					$_SESSION['userinfo']=$data['name'];
					$this->success("注册成功",U('Index/index'));
				}else{
					$this->error("注册系统出现异常");
				}
			}else{
				$this->error("注册系统出现异常");
			}
		}
		//用户退出
		public function logout(){
			unset($_SESSION['isLogin']);
			unset($_SESSION['mid']);
			unset($_SESSION['userinfo']);
			
			$this->success("用户退出成功",U('Index/index'));
		}
		
		public function setting(){
			$this->display("setting");
		}
		//更改密码
		public function doChangepwd(){
			if($_POST['oldpwd']){
				dump($_SESSION['vertify']);
//				验证验证码
				if($_SESSION['vertify']!=md5($_POST['vertify'])){
					
					$this->error("验证码错误");
				}
				$user=new MongoModel("user");
				$map["_id"]=$_SESSION['mid'];
				$map['password']=md5($_POST['oldpwd']);
				echo $map['password'];
				echo $_SESSION['mid'];
				$re=$user->where($map)->find();
				dump($re);
				//原密码错误
				if(!$re){
//					$this->error("原密码错误");
					return false;
				}
				$data['password']=md5($_POST['newpwd']);
				$re=$user->where(array('_id'=>$_SESSION['mid']))->save($data);
//				修改密码后要求重新登录
				if($re){
					unset($_SESSION['mid']);
					unset($_SESSION['isLogin']);
					unset($_SESSION['userinfo']);
					$this->success("密码修改成功",U('User/login'));
				}else{
					$this->error("系统出现错误");
				}
				
			}
		}
		//更改头像
		public function changeavater(){
			$user=new MongoModel("user");
			$info=$user->find($_SESSION['mid']);
			dump($info);
			$this->assign("info",$info);
			$this->display("User/changeavater");	
		}
		//上传头像
		public function uploadAvatar(){
//			使用到thinkphp里一个上传插件，把选中的文件上传到upload文件夹
			if($_FILES){
				import("ORG.Net.UploadFile");
				$upload=new UploadFile();  //实例化上传类
				$upload->maxSize=3145728;  //设置附件上传大小
				$upload->allowExt=array("jpg","gif","png","jpeg");   //设置附件上传类型
				$upload->savePath='./Upload/';  //设置附件上传目录
				$upload->thumb=true;   //生成缩略图
				$upload->thumbMaxWidth="100";
				$upload->thumbMaxHeight="100";
				
				if(!$upload->upload()){   //上传错误提示信息
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();  //上传成功，获取上传文件信息
					dump($info);
					$user=new MongoModel("user");
					$re=$user->where(array("_id"=>$_SESSION['mid']))->save(array("avatar"=>$info[0]['savename']));
					
					$this->success("上传成功",U('User/changeavater'));
				}
			}else{
				$this->error("upload error");
			}
		}
		public function vertify(){
			import("ORG.Util.Image");   //引入验证码类库
			Image::buildImageVerify(4,1,'png',80,30,'vertify');
//			dump($_SESSION['vertify']);
//			$this->redirect("/User/changepwd");
		}
	}
?>