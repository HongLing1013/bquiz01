<?php
include_once "../base.php";

// 檢查是否有圖片
$DB=new DB($_POST['table']);
$data=[];
$data['id']=$_POST['id'];
if(isset($_FILES['img']['tmp_name'])){/* 如果路徑存在 表示上傳成功
  就要把檔案從暫存的目錄移至img中
  檔名就是上傳時的黨名 */
  move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
  $data['img']=$_FILES['img']['name'];
}

$DB->save($data);

to("../back.php?do={$_POST['table']}");

?>