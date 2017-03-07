<?php
	class CommentDiggWidget extends Widget{
		public function render($data){
			
			if(is_array($data)){
				$val=$data;
			}
			//通过文章的uid和comment_id来查看当前点赞模块
			$topic_digg=new MongoModel("comment_digg");
			$re=$topic_digg->where($val)->count();
			
			$val['diggs']=$re;
			
			//对于当前评论你是否赞了,点赞表里保存有点赞人的id，可以根据是否有数据而得出是否点赞
			$sum=$topic_digg->where(array("uid"=>$_SESSION['mid']))->find();
			if(!$sum){
				$val['type']=1;
				$val['text']="赞";
			}else{
				$val['type']=0;
				$val['text']="取消赞";
			}
			$content=$this->renderFile("digg",$val);
			return $content;
		}
		
	}
?>