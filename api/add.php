<?php
include_once "../base.php";
$DB=new DB($_POST['table']);

$data=[];
if(isset($_FILES['img']['tmp_name'])){/* 如果路徑存在 表示上傳成功
                                         就要把檔案從暫存的目錄移至img中
                                         檔名就是上傳時的黨名 */
  move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
  $data['img']=$_FILES['img']['name'];
}

if(isset($_POST['text'])){/* 如果有文字的話
                             就在裡面加上文字內容 */
  $data['text']=$_POST['text'];
}

switch($_POST['table']){/* 針對table的內容
                           不同的資料型態有不同的處理方式 */
  case 'title':
    $data['sh']=0;
    break;
  case 'admin':
    $data['acc']=$_POST['acc'];
    $data['pw']=$_POST['pw'];
    break;
  case 'menu':
    $data['text']=$_POST['text'];
    $data['href']=$_POST['href'];
    $data['sh']=1;
    break;
  default:
    $data['sh']=1;
}

$DB->save($data);

to("../back.php?do=$DB->table");

?>