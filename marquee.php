<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
     <?php
     $ads=$Ad->all(["sh"=>1]); /* sh設為1的是要顯示的資料
                                  所以只要撈出要顯示的資料 */
      foreach($ads as $ad){//印出要顯示的資料
            echo $ad['text'];
            echo "&nbsp;&nbsp;/&nbsp;&nbsp;";//使用空白隔開
      }
     
     
     
     ?>             	                    
</marquee>