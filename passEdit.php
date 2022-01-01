<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　パスワード変更ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// DBからユーザーデータを取得
$userData = getUser($_SESSION['user_id']);
debug('取得したユーザー情報：'.print_r($userData,true));

//post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
  
  //変数にユーザー情報を代入
  $pass_old = $_POST['pass_old'];
  $pass_new = $_POST['pass_new'];
  $pass_new_re = $_POST['pass_new_re'];

  //未入力チェック
  validRequired($pass_old, 'pass_old');
  validRequired($pass_new, 'pass_new');
  validRequired($pass_new_re, 'pass_new_re');

  if(empty($err_msg)){
    debug('未入力チェックOK。');
    
    //古いパスワードのチェック
    validPass($pass_old, 'pass_old');
    //新しいパスワードのチェック
    validPass($pass_new, 'pass_new');
    
    //古いパスワードとDBパスワードを照合
    if(!password_verify($pass_old, $userData['password'])){
      $err_msg['pass_old'] = MSG12;
    }
    
    //新しいパスワードと古いパスワードが同じかチェック
    if($pass_old === $pass_new){
      $err_msg['pass_new'] = MSG13;
    }
    //パスワードとパスワード再入力が合っているかチェック
    validMatch($pass_new, $pass_new_re, 'pass_new_re');
    
    if(empty($err_msg)){
      debug('バリデーションOK。');

      //例外処理
      try {
        // DBへ接続
        $dbh = dbConnect();
        // SQL文作成
        $sql = 'UPDATE shop SET password = :pass WHERE id = :id';
        $data = array(':id' => $_SESSION['user_id'], ':pass' => password_hash($pass_new, PASSWORD_DEFAULT));
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);

        // クエリ成功の場合
        if($stmt){
          $_SESSION['msg_success'] = SUC01;
          header("Location:mypage.php"); //マイページへ
          return $_SESSION['msg_success'];
        }

      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $err_msg['common'] = MSG07;
      }
    }
  }
}
?>
<?php
$siteTitle = 'パスワード変更';
require('head.php'); 
?>

  <body>
    <!-- メニュー -->
    <?php
      require('header.php'); 
    ?>

<!-- Main -->
<section class="container container-ornament container-body">
    <h2 class="container-title">
        <span class="sub-title sub-title-reserve">Edit</span>
        <span class="main-title main-title-reserve">パスワードを変更する</span>
    </h2>
    
    <div class="container-reserve">
    <div class="container container-form">
        
         <form action="" method="post" class="reserve-form">
           <div class="area-msg area-msg-notice">
             <?php 
              if(!empty($err_msg['common'])) echo $err_msg['common'];
             ?>
           </div>
            <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass_old'])) echo 'err'; ?>">
              古いパスワード
              <input type="password" class="box-number" name="pass_old" value="<?php echo getFormData('pass_old'); ?>">
            </label>
            <div class="area-msg">
              <?php 
              echo getErrMsg('pass_old');
              ?>
            </div>
            <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass_new'])) echo 'err'; ?>">
              新しいパスワード
              <input type="password" class="box-number" name="pass_new" value="<?php echo getFormData('pass_new'); ?>">
            </label>
            <div class="area-msg">
              <?php 
                echo getErrMsg('pass_new');
              ?>
            </div>
            <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass_new_re'])) echo 'err'; ?>">
              新しいパスワード<br>（再入力）
              <input type="password" class="box-number" name="pass_new_re" value="<?php echo getFormData('pass_new_re'); ?>">
            </label>
            <div class="area-msg">
              <?php 
              echo getErrMsg('pass_new_re');
              ?>
            </div>
            <div class="btn-container">
            <button type="submit" name="btn_confirm" value="btn_confirm" class="btn btn-flat btn-flat-button">
                <span>変更する</span> 
            </button>
            </div>
          </form>
        </div>
      </div>
    </section>
      
<!-- サイドバー -->
<?php
require('sidebar.php');
?>
<!-- footer -->
<?php
require('footer.php'); 
?>
