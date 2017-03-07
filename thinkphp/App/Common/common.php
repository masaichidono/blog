<?php
function test_name($name){
	return "name：".$name;
}
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}
//验证用户是否拥有当前的权限
/*
 * permission_node  type和name为唯一标记的权限node
 * mid当前用户 		user->permission_node 里面是否有当前传入的权限
 * 
 */
 function checkPermission($type,$name,$msg){
 	//验证用户是否登录，并且权限节点不为空
 	$mid=$_SESSION['mid'];
	if(!mid || $type||$name){
		return false;
	}
	dump("1");
	//对当前用户进行判断
	//根据mid来查询出用户都有哪些权限， 在user集合permission_node中
	//查询用户所有的权限
	//根据type和name来进行查询
	//返回 true false
	//查询用户的所有权限
	$user=new MongoModel('user');
	$ids=$user->getField("permission_node")->find($mid);
	dump($ids);
	//查询当前的权限节点是否存在
	$permission=new MongoModel("permission");
	
	$map['type']=$type;
	$map['name']=$name;
	$re=$permission->where($map)->find();
	dump($re);
	if($re){
		if(in_array($re['_id'], $ids)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
	
 }
?>