<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">動態廣告文字管理</p>
    <form method="post" target="back" action="?do=tii">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">動態廣告文字內容</td>
                    <td width="10%">顯示</td>
                    <td>刪除</td>
                </tr>
                <?php
                    $rows=$Ad->all();//撈出所有資料
                    foreach($rows as $row){
                ?>
                <tr>
                    <td>
                        <input type="text" name="text" value="<?=$row['text'];?>">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>">
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" id="<?=$row['id'];?>">
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button" onclick="op('#cover','#cvr','./modal/ad.php')" value="新增動態廣告文字圖片"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>

    </form>
</div>