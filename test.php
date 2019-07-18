<?php
header('Content-type:text/html;charset=utf-8');
require_once $_SERVER['DOCUMENT_ROOT'].'/myblog/lib/Db.php';
$db=new Db();
// $res=$db->table('article')->field('title.id')->order('id desc')->where(id>1)->limit(12)->lists();
/*
$data =array('uid'=>2,'cid'=>3,'title'=>'数据库添加22','pv'=>0);
$id=$db->table('article')->insert($data);
echo '<pre>';
var_dump($id);

//$res=$db->table('article')->where(array('id'=>1))->delete();

$data=array('title'=>'数据库更新','pv'=>34);
$res=$db->table('article')->where(array('id'=>1))->update();
 var_dump($res);
 "delete from article where id=1";
"insert into article(uid,cid,title,pv)values(2,3,'数据库添加',8)";
"update article set title='数据库更新' where id=1";
*/

//分页查询
//$cid=$_GET['cid'];
$page=$_GET['page'];//第几页
$pageSize=2;//每页加载几条数据


$res=$db->table('article')->field('id,title')->where('id>1')->pages($page,$pageSize,'./test.php');
?>

<!-- echo '<pre>';
print_r($res);
echo '共查询出'.$res['total'].'条数据<br>';
foreach ($res['data'] as $key => $value) {
  echo $value['title'].'<br>';
} -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分页</title>
	<link rel="stylesheet" href="./static/plugins/bootstrap/css/bootstrap.min.css" type="text/css">
</head>
<body>
<div class="container" style="margin-top: 50px;">
	<p>共查询出<?php echo $res['total']?>条数据</p>
	<table class="table table-bordered">
       <thead>
       	<tr>
       		<th>ID</th>
       		<th>标题</th>
       	</tr>
       </thead>
       <tbody>
       	   <?php foreach($res['data'] as $article){?>
       	<tr>
       		<th><?php echo $article['id'] ?></th>
       		<th><?php echo $article['title'] ?></th>
       	</tr>
       <?php } ?>
    </tbody>
    </table>
     
     <div>
       <?php echo $res['pages'] ?>
     </div>
    

   
</div>

	
	
</body>
</html>