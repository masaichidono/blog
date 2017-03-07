<?php


	class DiggAction extends Action {
	
	//
	private $mongo_topic=null;
	private $mongo_category=null;
	private $mongo_user=null;
	private $mongo_comment=null;
	private $mongo_comment_digg=null;
	//初始化方法
	protected function 	_initialize(){
		$this->mongo_topic=new MongoModel("topic");
		$this->mongo_category=new MongoModel("category");
		$this->mongo_user=new MongoModel("user");
		$this->mongo_comment=new MongoModel("comment");
		$this->mongo_comment_digg=new MongoModel("comment_digg");
	} 
	public function addDigg(){
		if($_POST['comment_id']){
			//判断用户是否登录
			if($_SESSION['isLogin']!=1){
				echo 0;
				exit();
			}
			//给评论添加赞数据
			$data['comment_id']=$_POST['comment_id'];
			$data['uid']=$_SESSION['mid'];
			$data['created_date']=time();
			
			$re=$this->mongo_comment_digg->add($data);
			if($re){
				echo 1;
				exit();
			}else{
				echo 2;
				exit();
			}
		}
	}
	public function cancelDigg(){
			$comment_id=$_POST['comment_id'];
			$uid=$_POST['uid'];
			
			if(!$comment_id||!$uid){
				echo 2;
				exit();
			}
			$comment_digg=new MongoModel('comment_digg');
			
			$re=$comment_digg->where(array('comment_id'=>$comment_id,'uid'=>$uid))->delete();
			
			if($re){
				echo 1;
				exit();
			}else{
				echo 2;
				exit();
			}
		}
}
?>