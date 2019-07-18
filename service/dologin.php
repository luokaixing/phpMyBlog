<?php
header('Content-type:text/html;charset=utf-8');

// 登录验证
$username = $_POST['username'];
$pwd = $_POST['pwd'];


// 验证用户名和密码

require_once $_SERVER['DOCUMENT_ROOT'].'/myblog/lib/Db.php';
$db = new Db();

$user = $db->table('user')->where(array('username'=>$username))->item();
if(!$user){
		exit(json_encode(array('code'=>1,'msg'=>'该用户不存在')));
		
}
// 验证密码
if($user['password'] !=$pwd){
		exit(json_encode(array('code'=>1,'msg'=>'密码不正确')));
		
}

// 保存session
session_start();
$_SESSION['user'] = $user;
   exit(json_encode(array('code'=>0,'msg'=>'登录成功')));

  