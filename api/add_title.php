<?php
include_once "../base.php";
$text=$_POST['text'];

// 檢查是否有圖片
if(isset($_FILES['img']['tmp_name'])){// 移動圖片到img
  move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
  $img=$_FILES['img']['name'];//檔案名稱
}

/* 正常在此處要做檔案的判別 
   但因考試時間有限
   如果這個要拿去當作品
   需要加回判斷式 */

$data=['img'=>$img,'text'=>$text,'sh'=>0];//要寫入的資料格式
$title=new DB('title');
$title->save($data);

to("../back.php?do=title");

?>