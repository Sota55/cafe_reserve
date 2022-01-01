<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　退会ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  //例外処理
  try {
    // DBへ接続
    $dbh = dbConnect();
    // SQL文作成
    $sql = 'UPDATE shop SET delete_flg = 1 WHERE id = :us_id';
    // データ流し込み
    $data = array(':us_id' => $_SESSION['user_id']);
    // クエリ実行
    $stmt = queryPost($dbh, $sql, $data);

    // クエリ実行成功の場合
    if($stmt){
     //セッション削除
      session_destroy();
      debug('セッション変数の中身：'.print_r($_SESSION,true));
      debug('トップページへ遷移します。');
      header("Location:signup.php");
    }else{
      debug('クエリが失敗しました。');
      $err_msg['common'] = MSG07;
    }

  } catch (Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    $err_msg['common'] = MSG07;
  }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = '退会';
require('head.php'); 
?>

  <body>
    <!-- ヘッダー -->
    <?php
    require('header.php'); 
    ?>

    <!-- メインコンテンツ -->
    <!-- Main -->
<section class="container container-ornament container-body">
    <h2 class="container-title">
        <span class="sub-title sub-title-reserve">Withdraw</span>
        <span class="main-title main-title-reserve">退会する</span>
    </h2>
    
    <form action="" method="post" class="reserve-form">
      <div id="contents" class="container">
        <div class="area-msg">
          <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
        </div>
        <div class="btn-container">
          <button type="submit" name="submit" value="退会する" class="btn btn-flat btn-flat-button">
            <span>退会する</span> 
          </button>
          <a href="mypage.php">&lt; マイページに戻る</a>
        </div>
      </div>
    </form>
</section>
<!-- サイドバー -->
<?php
  require('sidebar.php');
?>
<!-- footer -->
<?php
require('footer.php'); 
?>