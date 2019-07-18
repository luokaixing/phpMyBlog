<?php
if($_FILES['file_image']['error']>0){
	exit(json_encode(array('errno'=>1,'data'=>array())));

}

$allows=array('image/jpeg','image/png');
if(!in_array($_FILES['file_image']['type'],$allows)){
	exit(json_encode(array('errno'=>1,'data'=>array())));
}
move_uploaded_file($_FILES['file_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/myblog/images/'.$_FILES['file_image']['name']);
exit(json_encode(array('errno'=>0,'data'=>array('/myblog/images/'.$_FILES['file_image']['name']))));
