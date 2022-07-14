<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php"; ?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<div class="cent">更多最新消息顯示區</div>
	<hr>


	<?php
	// 做分頁
	$all = $News->math('count', "id",['sh'=>1]);
	$div = 5; //每5筆資料為一頁
	$pages = ceil($all / $div); //算頁數
	$now = $_GET['p'] ?? 1; //取得當前頁面
	$start = ($now - 1) * $div; //從哪裡開始計算
	$rows = $News->all(" limit $start,$div");/* 撈出的資料是哪邊到哪邊
																													這段語法等同select * from table limit 0,3 => 撈出 0.1.2
																													或者select * from table limit 3,3 => 撈出 3.4.5
																													或 select * from table limit 6,3 => 撈出 6.7.8 */
	echo "<ol start='".($start+1)."'>";
	foreach ($rows as $row) {
		echo "<li class='sswww'>";
		echo mb_substr($row['text'],0,20);
		echo "<span class='all' style='display:none'>";
		echo $row['text'];
		echo "</span>";
		echo "</li>";
	}
	echo "</ol>";
	?>
	</tbody>
	</table>
	<div class="cent">
		<?php
		if (($now - 1) > 0) { //如果有上一頁的話 就顯示<的按鈕
			$p = $now - 1;
			echo "<a href='?do={$Str->table}&p=$p'> < </a>";
		}
		for ($i = 1; $i <= $pages; $i++) { // 印頁碼
			$fontsize = ($now == $i) ? '1.5rem' : ''; //當前頁數字體放大
			echo "<a href='?do={$Str->table}&p=$i' style='font-size:$fontsize'> "; //?代表當前頁面
			echo $i;
			echo " </a>";
		}
		if (($now + 1) <= $pages) { //如果有下一頁的話 就顯示>的按鈕
			$p = $now + 1;
			echo "<a href='?do={$Str->table}&p=$p'> > </a>";
		}
		?>

	</div>




</div>
<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
<script>
	$(".sswww").hover(
		function() {
			$("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({
				"top": $(this).offset().top - 50
			})
			$("#alt").show()
		}
	)
	$(".sswww").mouseout(
		function() {
			$("#alt").hide()
		}
	)
</script>