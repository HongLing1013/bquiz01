<!-- 資料庫裡面menu的parent數字是0 => 主選單
     如果是其他數字 則為id是相同數字的欄位之副選單 -->

<?php
include_once "../base.php";

$subs=$Menu->all(['parent'=>$_GET['id']]);//拉出來的結果為對應id的複選單


?>

<h3 class="cent">編輯次選單</h3>
<hr>
<form action="./api/edit_sub.php" method="post"></form>
<table style="width: 70%; margin: 0 auto">
  <tr>
    <td>次選單名稱</td>
    <td>次選單連結網址</td>
    <td>刪除</td>
  </tr>
  <?php
    foreach($subs as $sub){
  ?>
  <tr>
    <td><input type="text" name="text[]" value="<?=$sub['text'];?>"></td>
    <td><input type="text" name="href[]" value="<?=$sub['href'];?>"></td>
    <td><input type="checkbox" name="del[]" value="<?=$sub['id'];?>"></td>
  </tr>
  <?php
  }
  ?>
</table>