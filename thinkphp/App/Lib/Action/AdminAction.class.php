<?php
	class AdminAction extends Action{
		
	
	 //本控制器是后台登录的唯一入口
		private $mongo_topic=null;
		private $mongo_category=null;
		private $mongo_user=null;
		private $mongo_comment=null;
		//初始化方法
		protected function 	_initialize(){
			//判断用户是否登录，如果已经登录，该用户是否有权限进入后台
			if($_SESSION['isLogin']!=1){
				$this->error("请登录后再进入",U("User/login"));
			}
			$this->mongo_topic=new MongoModel("topic");
			$this->mongo_category=new MongoModel("category");
			$this->mongo_user=new MongoModel("user");
			$this->mongo_comment=new MongoModel("comment");
		}
		public function index(){
			$re=checkPermission("login", "admin", "hello");
			//给导航栏切换选中效果
			$this->assign("index","class='active'");
			$this->display("index"); 
			
		}
		//话题管理模块
		public function topicLists(){
			//分页
	    	import('ORG.Util.Page');
			$counts=$this->mongo_topic->count();
			$page=new Page($counts,5);
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
				$val['type_id']=='0'?$lists[$key]['typename']='未分类':$lists[$key]['typename']=$val['type_id'];
				//查询当前的topic是否有评论
				$lists[$key]['commentlist']=$this->mongo_comment->where(array('topic_id'=>$val['_id']))->select();
				//截取内容作为简介
				$temp=msubstr(strip_tags($val['content']),0,20);
				
//				去掉内容的标签
				
				$lists[$key]['jianjie']=$temp;
				$lists[$key]['action']="<a class='btn btn-primary btn-mini' href='".U('Admin/editTopic',array('id'=>$val['_id']))."'>编辑</a>&nbsp;<a class='btn btn-danger btn-mini' href='".U("Admin/delTopic",array('id'=>$val['_id']))."'>删除</a>";
			}
//			dump($lists);
			
			$this->assign("lists",$lists);
//			dump($lists);
			//给导航栏切换选中效果
			$this->assign("topic","class='active'");
			$this->display("topicLists");
		}
//			删除话题
			/*
			 * 批量删除的实现
			 */
			public function delTopic(){
				//判断当前用户是否有权限
				if(!checkPermission("manage", "admin", "hello")){
					echo "<script>alert('对不起，你没有修改的权限')</script>";
					$this->error();
					return;
				}
				if($_GET['id']){
					$re=$this->mongo_topic->delete($_GET['id']);
					if($re){
						$this->success("删除成功",U("Admin/topicLists"));
					}else{
						$this->error("删除失败",U("Admin/topicLists"));
					}
				}else{
					$this->error();
				}
			}
			/*
			 * 更新，编辑
			 *
			 */
			 public function editTopic(){
			 	//判断当前用户是否有权限
				if(!checkPermission("manage", "admin", "hello")){
					echo "<script>alert('对不起，你没有修改的权限')</script>";
					$this->error();
					return;
				}else{
					$id=$_GET['id'];
					$data=$this->mongo_topic->find($id);
					//分类
					$re=$this->mongo_category->select();
					
					$this->assign("typelist",$re);
					$this->assign("data",$data);
					$this->assign("topic","class='active'");
				 	$this->display("editTopic");
					}
			 	
			 }
			public function doEditTopic(){
				$this->assign("topic","class='active'");
			 	//进行数据操作
				if($_POST){
					$data['title']=$_POST['topic_title'];
					$data['content']=$_POST['topic_content'];
					$data['type_id']=$_POST['type'];
					$data['visible']=$_POST['visible'];
					$data['tag']=$_POST['topic_tag'];
					$data['update_date']=time();
					
					$map['_id']=$_POST['topic_id'];
					$re=$this->mongo_topic->where($map)->save($data);
					
					if($re){
						redirect(U('Admin/topicLists'));
					}
				}else{
					$this->error("修改错误");
				}
			}
	}
	?>
	