<?php
	class UserInfoWidget extends Widget{
		//根据用户登录与否的状态，来显示
		public function render($data){
			$mid=$_SESSION['mid'];
			if($mid){
				$var=$this->getUserInfo($mid);
				$tpl="userinfo";
			}else{
				$tpl="unlogin";
			}
			$content=$this->renderFile($tpl,$var);
			return $content;
		}
		private function getName($name){
			return "你的名称".$name;
		}
		private function getUserInfo($mid){
			$user=new MongoModel("user");
			return $user->find($mid);
		}
	}
?>