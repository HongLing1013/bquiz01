<?php
include_once "../base.php";

// 檢查是否有圖片
if(isset($_FILES['img']['tmp_name'])){// 移動圖片到img
  move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
  $img=$_FILES['img']['name'];//檔案名稱
}

/* 正常在此處要做檔案的判別 
   但因考試時間有限
   如果這個要拿去當作品
   需要加回判斷式 */

$id=$_POST['id'];//取得id
$row=$Title->find($id);//取得要更改資料的內容
$row['img']=$img;//將圖片改成新的img
$Title->save($row);

to("../back.php?do=title");

?>