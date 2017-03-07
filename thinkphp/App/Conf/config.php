<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               => 'mongo',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'blog',          // 数据库名
    'DB_USER'               => '',      // 用户名
    'DB_PWD'                => '',          // 密码
    'DB_PORT'               => '27017',        // 端口
    'DB_PREFIX'             => '',    // 数据库表前缀
    /* 错误设置 */
    'ERROR_MESSAGE'         => '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
//  'ERROR_PAGE'            => '',	// 错误定向页面
    'SHOW_ERROR_MSG'        => TRUE,    // 显示错误信息
    'TRACE_EXCEPTION'       => TRUE,   // TRACE错误信息是否抛异常 针对trace方法 
    'WEB_NAME'				=> "masaichi",
    'WEB_HEADER_DESC'		=>"MASAICHI",
    //自定义跳转模板 的路径
    'TMPL_ACTION_ERROR'     => "Public:error", // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => "Public:success", // 默认成功跳转对应的模板文件
    'URL_CASE_INSENSITIVE ' =>TRUE,
);
?>