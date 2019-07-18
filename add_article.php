<?php
// 验证用户是否已登录
session_start();
$user = $_SESSION['user'];
if(!$user){
	exit('您还未登录，请先登录后再发表博客!');
}
require_once $_SERVER['DOCUMENT_ROOT'].'/myblog/lib/Db.php';
$db = new Db();
$cates = $db->table('cates')->lists();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>发表博客</title>
	<link rel="stylesheet" type="text/css" href="./static/plugins/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="./static/js/jquery.min.js"></script>
	<script type="text/javascript" src="./static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./static/js/UI.js"></script>
	<script type="text/javascript" src="./static/plugins/wangEditor/release/wangEditor.min.js"></script>
	<style type="text/css">
		.form{margin: 10px 0px;}
		.form .input-group{margin: 20px 0px;}
	</style>
</head>
<body>
	<div class="form">
		<div class="input-group input-group-sm">
		  <span class="input-group-addon">博客标题</span>
		  <input type="text" class="form-control" name="title" placeholder="请输入博客标题">
		</div>
		<div class="input-group input-group-sm">
		  <span class="input-group-addon">博客分类</span>
		  <select class="form-control" name="cid">
		  	<?php foreach($cates as $cate){?>
		  	<option value="<?php echo $cate['id']?>"><?php echo $cate['title']?></option>
		  	<?php }?>
		  </select>
		</div>

		<div class="input-group input-group-sm">
		  <span class="input-group-addon">关键字</span>
		  <input type="text" class="form-control" name="keywords" placeholder="请输入博客关键字">
		</div>
		<div class="input-group input-group-sm">
		  <span class="input-group-addon">描述</span>
		  <input type="text" class="form-control" name="desc" placeholder="请输入博客描述">
		</div>
		
		<div class="input-group input-group-sm">
		  <span class="input-group-addon">博客内容</span>
		  <div id="editor"></div>
		</div>
		<button class="btn btn-primary" style="float: right;" onclick="save();return false">保存</button>
	</div>
</body>
</html>
<script type="text/javascript">
    var editor;
	// 初始化富文本编辑器
	function initEditor(){
		var E=window.wangEditor;
		editor=new E('#editor');
		editor.customConfig.uploadImgServer='./upload.php';
		editor.customConfig.uploadFileName='file_image';
		editor.create();
	}
    initEditor();
     
    function save(){
    	var data=new Object;
    	data.title=$.trim($('input[name="title"]').val());
    	data.cid=$.trim($('select[name="cid"]').val());
    	data.keywords=$.trim($('input[name="keywords"]').val());
    	data.desc=$.trim($('input[name="desc"]').val());
        data.contents=editor.txt.html();
        if(data.name == ''){
        	UI.alert({msg:'请输入博客标题',icon:'error'});
        	return;
        }
        if(data.contents == '<p><br></p>'){
        	UI.alert({msg:'请输入博客内容',icon:'error'});
        	return;
        }
        $.post('./service/save_article.php',data,function(res){
           if(res.code>0){
				UI.alert({msg:res.msg,icon:'error'});
			}else{
				UI.alert({msg:res.msg,icon:'ok'});
				setTimeout(function(){parent.window.location.reload();},1000);
			}
        	},'text');
    }


</script>