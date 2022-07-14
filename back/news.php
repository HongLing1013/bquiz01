<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$Str->header;?></p>
    <form method="post" action="./api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%"><?=$Str->tdHead[0];?></td>
                    <td width="10%">顯示</td>
                    <td>刪除</td>
                </tr>
                <?php
                    // 做分頁
                    $all=$DB->math('count',"id");
                    $div=4;//每4筆資料為一頁
                    $pages=ceil($all/$div);//算頁數
                    $now=$_GET['p']??1;//取得當前頁面
                    $start=($now-1)*$div;//從哪裡開始計算
                    $rows=$DB->all(" limit $start,$div");/* 撈出的資料是哪邊到哪邊
                                                            這段語法等同select * from table limit 0,3 => 撈出 0.1.2
                                                            或者select * from table limit 3,3 => 撈出 3.4.5
                                                            或 select * from table limit 6,3 => 撈出 6.7.8 */
                    foreach($rows as $row){
                ?>
                <tr>
                    <td>
                        <textarea name="text[]" style="width:95%;height:60px"><?=$row['text'];?></textarea>
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                        <!-- 如果$row['sh']==1 就顯示 不然就為空 -->
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                </tr>
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                <?php
                    }
                ?>
            </tbody>
        </table>
        <div class="cent">
            <?php
                    if(($now-1) > 0){//如果有上一頁的話 就顯示<的按鈕
                        $p=$now-1;
                        echo "<a href='?do={$Str->table}&p=$p'> < </a>";
                    }
                    for($i=1;$i<=$pages;$i++){// 印頁碼
                        $fontsize=($now==$i)?'1.5rem':'';//當前頁數字體放大
                        echo "<a href='?do={$Str->table}&p=$i' style='font-size:$fontsize'> ";//?代表當前頁面
                        echo $i;
                        echo " </a>";
                    }
                    if(($now+1) <= $pages){//如果有下一頁的話 就顯示>的按鈕
                        $p=$now+1;
                        echo "<a href='?do={$Str->table}&p=$p'> > </a>";
                    }
                ?>

        </div>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button" onclick="op('#cover','#cvr','./modal/<?=$Str->table;?>.php?do=<?=$Str->table;?>')" value="<?=$Str->addBtn;?>"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>
            <input type="hidden" name="table" value="<?=$do;?>">
    </form>
</div>