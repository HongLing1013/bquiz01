<?php
include_once "../base.php";

//編輯和刪除,依據$_POST['id']

if(!empty($_POST['id'])){/* 判定有沒有id送過來
  有才需要執行下面的迴圈
  不然就回到本來的地方 */
foreach ($_POST['id'] as $idx => $id){/* 因為post傳來的資料是id
               所以變數也是取名$id
               $idx則是它的索引值 */
if(isset($_POST['del']) && in_array($id,$_POST['del'])){/* 判斷有沒有資料需要刪除
                                     並用in_array判斷迴圈輪到的這個id是否有在POST裡面del的陣列中
                                     如果有表示這筆資料需要刪除 */
$Menu->del($id);
}else{
$row=$Menu->find($id);///只有下面這兩個資料需要變更
$row['text']=$_POST['text'][$idx];
$row['href']=$_POST['href'][$idx];
$Menu->save($row);/* 更新後儲存 */
}
}
}

// 新增資料,依據$_POST['text2']或是$_POST['href2']
if(isset($_POST['text2'])){/* 判斷選單文字是否存在 */
  foreach($_POST['text2'] as $idx => $text){
    if($text!=''){/* 判斷是不是空值 */
    $data['text']=$text;/* 建立一個暫時的資料 */
    $data['href']=$_POST['href2'][$idx];/* 建立一個暫時的連結 */
    $data['parent']=$_POST['parent'];
    $Menu->save($data);/* 存到資料庫
                          有id是更新
                          沒id會是新增 */
    }
  }
}

to("../back.php?do=menu");
?>