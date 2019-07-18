<?php
header('Content-type:text/html;charset=utf-8');
session_start();
$user =isset($_SESSION['user'])?$_SESSION['user']:false;
if(!$user){
	exit(json_encode(array('code'=>1,'msg'=>'您还未登录')));
}
$data['uid']=$user['uid'];
$data['title']=trim($_POST['title']);
$data['cid']=(int)$_POST['cid'];
$data['keywords']=trim($_POST['keywords']);
$data['desc']=trim($_POST['desc']);
$data['contents']=htmlspecialchars(trim($_POST['contents']),true);
$data['add_time']=time();
if(!$data['title']){
	exit(json_encode(array('code'=>1,'msg'=>'请输入标题')));
}

require_once $_SERVER['DOCUMENT_ROOT'].'/myblog/lib/Db.php';
$db = new Db();
$id=$db->table('article')->insert($data);
if(!$id){
    exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
}
exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
?>