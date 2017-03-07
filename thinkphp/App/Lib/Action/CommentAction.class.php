<?php

	
	class CommentAction extends Action{
		
		private $mongo_topic=null;
		private $mongo_category=null;
		private $mongo_user=null;
		private $mongo_comment=null;
		//初始化方法
		protected function 	_initialize(){
			$this->mongo_topic=new MongoModel("topic");
			$this->mongo_category=new MongoModel("category");
			$this->mongo_user=new MongoModel("user");
			$this->mongo_comment=new MongoModel("comment");
		} 
		
		public function addComment(){
			if($_POST["comment_content"]){
				if($_SESSION['isLogin']==0){
					echo "0";
					exit();
				}else{
					$data['uid']=$_SESSION['mid'];
					$data['topic_id']=$_POST['topic_id'];
					$data['content']=$_POST['comment_content'];
					$data['created_date']=time();
					if($this->mongo_comment->add($data)){
						$this->mongo_topic->where(array('_id'=>$_POST['topic_id']))->setInc("comment_count",1);
						echo 1;
						exit();
					}else{
						echo 2;
						exit();
					}
				}
			}
//			dump($_POST);
		}
		
		
	}
?>
