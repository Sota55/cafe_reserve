<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログインページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// ログイン画面処理
//================================
// post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');

  //変数にユーザー情報を代入
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_save = (!empty($_POST['pass_save'])) ? true : false;

  //emailの形式チェック
  validEmail($email, 'email');
  //emailの最大文字数チェック
  validMaxLen($email, 'email');

  //パスワードチェック（半角英数字、最大文字数、最小文字数）
  validPass($pass, 'pass');
  
  //未入力チェック
  validRequired($email, 'email');
  validRequired($pass, 'pass');

  if(empty($err_msg)){
    debug('バリデーションOKです。');
    
    //例外処理
    try {
      // DBへ接続
      $dbh = dbConnect();
      // SQL文作成
      $sql = 'SELECT password,id FROM shop WHERE email = :email AND delete_flg = 0';
      $data = array(':email' => $email);
      // クエリ実行
      $stmt = queryPost($dbh, $sql, $data);
      // クエリ結果の値を取得
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      debug('クエリ結果の中身：'.print_r($result,true));
      
      // パスワード照合
      if(!empty($result) && password_verify($pass, array_shift($result))){
        debug('パスワードがマッチしました。');
        
        //ログイン有効期限（デフォルトを１時間とする）
        $sesLimit = 60*60;
        // 最終ログイン日時を現在日時に
        $_SESSION['login_date'] = time();
        
        // ログイン保持にチェックがある場合
        if($pass_save){
          debug('ログイン保持にチェックがあります。');
          // ログイン有効期限を30日にしてセット
          $_SESSION['login_limit'] = $sesLimit * 24 * 30;
        }else{
          debug('ログイン保持にチェックはありません。');
          // 次回からログイン保持しないので、ログイン有効期限を1時間後にセット
          $_SESSION['login_limit'] = $sesLimit;
        }
        // ユーザーIDを格納
        $_SESSION['user_id'] = $result['id'];
        
        debug('セッション変数の中身：'.print_r($_SESSION,true));
        debug('マイページへ遷移します。');
        header("Location:mypage.php"); //マイページへ
      }else{
        debug('パスワードがアンマッチです。');
        $err_msg['common'] = MSG09;
      }

    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = 'ログイン';
require('head.php'); 
?>
<!-- ヘッダー -->
<?php
  require('header.php'); 
?>

<body>
<!-- Main -->
<section class="container container-ornament container-body">
    <h2 class="container-title">
        <span class="sub-title sub-title-reserve">Login</span>
        <span class="main-title main-title-reserve">ログインする</span>
    </h2>
    
    <div class="container container-form">
    <div class="container-reserve">
        
        <form action="" method="post" class="reserve-form">
           <div class="area-msg area-msg-notice">
              <?php 
              if(!empty($err_msg['common'])) echo $err_msg['common'];
              ?>
           </div>
           <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
                メールアドレス
                <input class="box-number" type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
                <div class="area-msg">
                  <?php 
                  if(!empty($err_msg['email'])) echo $err_msg['email'];
                  ?>
              </div>
          </label>
          <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass'])) echo 'err'; ?>">
                パスワード
                <input class="box-number" type="password" name="pass" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass']; ?>">
                <div class="area-msg">
                  <?php 
                  if(!empty($err_msg['pass'])) echo $err_msg['pass'];
                  ?>
                </div>
          </label>
          <label class="reserve-form-item reserve-form-item-info">
             <input type="checkbox" name="pass_save">次回ログインを省略する
           </label>
          <div class="btn-container">
            <button type="submit" name="btn_confirm" value="btn_confirm" class="btn btn-flat btn-flat-button">
                <span>ログイン</span> 
            </button>
          </div>
            <!-- パスワードを忘れた方は<a href="passRemindSend.php">コチラ</a> -->
        </form>
    </div>
    </div>
</section>

<!-- footer -->
<?php
  require('footer.php'); 
?>
