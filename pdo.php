<?php
header('Content-type:text/html;charset=utf-8');

// 访问mysql数据库
$dsn = 'mysql:host=127.0.0.1;dbname=myblog';
$username = 'root';
$pwd = 'root';
$pdo = new PDO($dsn,$username,$pwd);

//$sql = 'select * from cates where id=:id';
//$sql = 'update cates set title="其他分类_php" where id=:id';
$sql = 'insert into cates(`title`)values(:title)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title','php分类');
$stmt->execute();
$id = $pdo->lastInsertId();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($id);
echo '<pre>';
//print_r($rows);