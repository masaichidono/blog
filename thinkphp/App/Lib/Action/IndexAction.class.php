<?php

class IndexAction extends Action {
	
	//
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
    public function index(){
    	//分页
    	import('ORG.Util.Page');
		$counts=$this->mongo_topic->count();
		$page=new Page($counts,10);
		//生成 下一页 上一页 代码
		$pages=$page->show();
		$this->assign("pages",$pages);
		$lists=$this->mongo_topic->limit($page->firstRow.",".$page->listRows)->select();
    	//综合讨论区，显示所有的话题
//		$lists=$this->mongo_topic->select();
		//格式化数据,因为需要从其他集合寻找数据
		foreach($lists as $key=>$val){
			$userinfo=$this->mongo_user->find($val['uid']);
			$lists[$key]['name']=$userinfo;
			$val['type_id']=='0'?$lists[$key]['typename']='未分类':$lists[$key]['typename']=$categoryinfo['name'];
			//查询当前的topic是否有评论
			$lists[$key]['commentlist']=$this->mongo_comment->where(array('topic_id'=>$val['_id']))->select();
		}
		$this->assign("lists",$lists);
		$this->display("index");
    }
	//显示发布话题的界面
	public function addTopic(){
		if($_SESSION['isLogin']!=1){
			$this->error("请先进行登录",U('User/login'));
		}
		//分类，显示分类的数据
		$re=$this->mongo_category->field("name")->select();
		$this->assign("typelist",$re);
		$this->display("addTopic");
	}
	//发布新话题
	public function addNewTopic(){
		if($_POST['topic_title']){
			$data['title']=$_POST['topic_title'];
			$data['content']=$_POST['topic_content'];
			$data['tag']=array('1','2','3');
			$data['type_id']=$_POST['type'];
			$data['uid']=$_SESSION['mid'];
			$data['comment_count']=0;
			$data['visible']=1;
			$data['created_date']=time();
			$data['hits']=0;
			
			$re=$this->mongo_topic->add($data);
			if($re){
				$this->success("发布成功",U("Index/index"));
			}else{
				$this->error("发布失败");
			}
		}else{
			dump("$var");
		}
		
	}
	//点击进入新的文章
	//根据id的不同，显示不同的文章
	public function topic_detail(){
		$id=$_GET['id'];
		if(!$id){
			$this->error("当前话题不存在或已被删除");
		}
		$re=$this->mongo_topic->find($id);
//		dump($re);
		if(!$re){
			$this->error("当前话题不存在或已被删除");
		}
		
		//id进行数据传输的安全性验证
		//获取用户信息
		$re["userinfo"]=$this->mongo_user->find($re['uid']);
		$re['typeinfo']=$this->mongo_category->find(array("name"=>$re['type_id']));
		
		//获取话题的所有评论
		$commentlists=$this->mongo_comment->where(array('topic_id'=>$re["_id"]))->select();
		
		$this->assign("commentlists",$commentlists);
		
		$this->assign("data",$re);
		$this->assign("tag",$re['tag']);
//		dump($re);
		$this->display("topic_detail");
	}
}