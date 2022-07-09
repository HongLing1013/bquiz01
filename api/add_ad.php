<?php
include_once "../base.php";
$text=$_POST['text'];

$data=['text'=>$text,'sh'=>1];//sh預設為顯示
$Ad->save($data);

to("../back.php?do=ad");

?>