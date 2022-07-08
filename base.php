<?php
// 設定時區
date_default_timezone_set('Asia/Taipei');
session_start();

class DB 
{ 
  //連線資料庫
  protected $dsn="mysql:host=localhost;charset=utf8;dbname=db15";
  protected $user='root';
  protected $pw='';
  protected $table;
  protected $pdo;

  public function __construct($table)
  {
    $this->table=$table; /* 上方protected 的 $table就是this
                            上方=後的$table就是construct($table)的table值
                            指定給this */
    $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
  }

  //存全部資料的function
  public function all(...$arg){
    $sql="select * from $this->table ";

    // 判斷第一個參數是否存在
    if(isset($arg[0])){ /* 如果存在 繼續下一輪判斷 
                           不存在 select全部 */

      // 判斷是陣列還是字串
      if(is_array($arg[0])){/* 如果是陣列 串成WHERE條件句 */

        // 印出陣列內容
        foreach($arg[0] as $key => $value){
          $tmp[]="`$key`='$value'";/* 建立一個暫時的陣列
                                      以欄位=value的方式排列儲存
                                      方便接下來串成WHERE條件句 */
        }

        // 串成條件句
        $sql .= " WHERE " . join(" AND ", $tmp);

      }else{ /* 如果不是陣列 即是字串
                就把字串串成句子 */

        // 串成句子
        $sql .= $arg[0];
      }
    }

    // 判斷第二個參數是否存在
    if(isset($arg[1])){
      $sql .= $arg[1];
    }
    // echo $sql; //測試用的echo

    // 回傳
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);/* 上方判斷完 如果沒帶任何參數的話 
                                                                  就撈出全部的資料並回傳 */
  }

  //找尋的 function
  public function find($id){/* 只取一筆 */
    $sql="select * from $this->table ";

      // 判斷id是陣列還是字串
      if(is_array($id)){/* 如果是陣列 串成WHERE條件句 */

        // 印出陣列內容
        foreach($id as $key => $value){
          $tmp[]="`$key`='$value'";/* 建立一個暫時的陣列
                                      以欄位=value的方式排列儲存
                                      方便接下來串成sql條件句 */
        }

        // 串成條件句
        $sql .= " WHERE " . join(" AND ", $tmp);

      }else{ /* 如果不是陣列 後面要加上WHERE */

        // 串成句子
        $sql .= "WHERE `id` = '$id' ";
      }

    // echo $sql; //測試用的echo

    // 回傳
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);/* 上方判斷完 如果沒帶任何參數的話 
                                                                  就撈出全部的資料並回傳 */
  }

  //刪除的 function
  public function del($id){/* 只取一筆 */
    $sql="DELETE * from $this->table ";

      // 判斷id是陣列還是字串
      if(is_array($id)){/* 如果是陣列 串成WHERE條件句 */

        // 印出陣列內容
        foreach($id as $key => $value){
          $tmp[]="`$key`='$value'";/* 建立一個暫時的陣列
                                      以欄位=value的方式排列儲存
                                      方便接下來串成sql條件句 */
        }

        // 串成條件句
        $sql .= " WHERE " . join(" AND ", $tmp);

      }else{ /* 如果不是陣列 後面要加上WHERE */

        // 串成句子
        $sql .= "WHERE `id` = '$id' ";
      }

    // echo $sql; //測試用的echo

    // 回傳
    return $this->pdo->exec($sql);/* 不須回傳所以使用exec
                                     return會回傳成功或失敗 */
  }

  //儲存的 function
  public function save($array){
    if(isset($array['id'])){/* 如果資料表有id這個欄位
                               代表這筆資料是資料庫撈出來的
                               就要做更新的動作 */
      foreach($array as $key => $value){
        if($key!='id'){/* id不用放進來 */

          $tmp[]="`$key`='$value'";/* 建立一個暫時的陣列
                                      以欄位=value的方式排列儲存
                                      方便接下來串成sql條件句 */
        }
      }                         
      $sql="UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='{$array['id']}'";

    }else{/* 如果沒有id的欄位代表是新資料
             就要執行新增的動作 */
      $sql="INSERT INTO $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
    }

    // echo $sql; //測試用的echo

    // 回傳
    return $this->pdo->exec($sql);/* 不須回傳所以使用exec
                                     return會回傳成功或失敗 */
  }

  //數學函式
  public function math($math,$col,...$arg){
    $sql="select $math($col) from $this->table ";/* 這段的$math($col)是寫死的
                                                    所以只會有一個單一的數值
                                                    不會有多筆資料 */

    // 判斷第一個參數是否存在
    if(isset($arg[0])){ /* 如果存在 繼續下一輪判斷 
                           不存在 select全部 */

      // 判斷是陣列還是字串
      if(is_array($arg[0])){/* 如果是陣列 串成WHERE條件句 */

        // 印出陣列內容
        foreach($arg[0] as $key => $value){
          $tmp[]="`$key`='$value'";/* 建立一個暫時的陣列
                                      以欄位=value的方式排列儲存
                                      方便接下來串成WHERE條件句 */
        }

        // 串成條件句
        $sql .= " WHERE " . join(" AND ", $tmp);

      }else{ /* 如果不是陣列 即是字串
                就把字串串成句子 */

        // 串成句子
        $sql .= $arg[0];
      }
    }

    // 判斷第二個參數是否存在
    if(isset($arg[1])){
      $sql .= $arg[1];
    }
    // echo $sql; //測試用的echo

    // 回傳
    return $this->pdo->query($sql)->fetchColumn();
  }

  // 萬用函式
  public function q($sql){
    // echo $sql;
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    /* 回傳二維陣列 */
  }

}

class Str{
  public $header;
  public $imgHead;
  public $textHead;
  public $updateImg;
  public $acc;
  public $pw;
  public $mainText;
  public $mainHref;
  public $subText;
  public $subHref;
  public $addBtn;
  public $addModalHeader;
  public $addModalcol;
  public $table;
  public function __construct($table)
  // 為了多語系的考量
  {
    $this->table=$table;
    switch($table){
      case 'title':
        $this->header="網站標題管理";
        $this->imgHead="網站標題";
        $this->textHead="替代文字";
        $this->updateImg="更新圖片";
        $this->addBtn="新增網站標題圖片";
        $this->addModalHeader="新增標題區圖片";
        $this->addModalcol=["標題區圖片","標題區替代文字"];
      break;
      case 'ad':
        $this->header="動態廣告文字管理";
        $this->textHead="動態廣告文字";
        $this->addBtn="新增動態文字廣告";
        $this->addModalHeader="新增動態文字廣告";
        $this->addModalcol=["動態文字廣告"];
      break;
      case 'image':
        $this->header="校園映像資料管理";
        $this->imgHead="校園映像資料圖片";
        $this->updateImg="更換圖片";
        $this->addBtn="新增校園映像圖片";
        $this->addModalHeader="新增校園映像圖片";
        $this->addModalcol=["校園映像圖片"];
      break;
      case 'mvim':
      break;
      case 'total':
      break;
      case 'bottom':
      break;
      case 'news':
      break;
      case 'admin':
      break;
      case 'menu':
      break;
    }
  }
}

// 簡化導向function
function to($url){
  header("location:".$url);
};

// 偵錯function
function dd($array){
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}

$Bot=new DB('bottom');
$Title=new DB('title');
$Ad=new DB('ad');
$Image=new DB('image');

$Str=new Str($do);

// 快速檢查
// $Bottom=new DB('bottom');
// print_r($Bottom->all(" where `id`='1'",' limit 1'));
?>