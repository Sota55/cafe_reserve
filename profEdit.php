<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　プロフィール編集ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// DBからユーザーデータを取得
$dbFormData = getUser($_SESSION['user_id']);

debug('取得したユーザー情報：'.print_r($dbFormData,true));

// post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));

  //変数にユーザー情報を代入
  $name = $_POST['name'];
  $email = $_POST['email'];

  //DBの情報と入力情報が異なる場合にバリデーションを行う
  if($dbFormData['name'] !== $name){
    //名前の最大文字数チェック
    validMaxLen($name, 'name');
  }
  if($dbFormData['email'] !== $email){
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    if(empty($err_msg['email'])){
      //emailの重複チェック
      validEmailDup($email);
    }
    //emailの形式チェック
    validEmail($email, 'email');
    //emailの未入力チェック
    validRequired($email, 'email');
  }

  if(empty($err_msg)){
    debug('バリデーションOKです。');

    //例外処理
    try {
      // DBへ接続
      $dbh = dbConnect();
      // SQL文作成
      $sql = 'UPDATE shop SET name = :u_name, email = :email WHERE id = :u_id';
      $data = array(':u_name' => $name , ':email' => $email, ':u_id' => $dbFormData['id']);
      // クエリ実行
      $stmt = queryPost($dbh, $sql, $data);

      // クエリ成功の場合
      if($stmt){
        $_SESSION['msg_success'] = SUC02;
        debug('マイページへ遷移します。');
        header("Location:mypage.php"); //マイページへ
        return $_SESSION['msg_success'];

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
$siteTitle = 'プロフィール編集';
require('head.php'); 
?>
  <!-- メニュー -->
  <?php
  require('header.php'); 
  ?>

<body>


  <!-- Main -->
<section class="container container-ornament container-body">
    <h2 class="container-title">
        <span class="sub-title sub-title-reserve">Edit</span>
        <span class="main-title main-title-reserve">プロフィールを編集する</span>
    </h2>
    
    <div class="container-reserve">
    <div class="container container-form">
        
         <form action="" method="post" class="reserve-form">
           <div class="area-msg area-msg-notice">
             <?php 
              if(!empty($err_msg['common'])) echo $err_msg['common'];
             ?>
           </div>
          <label class="reserve-form-item reserve-form-item-info<?php if(!empty($err_msg['name'])) echo 'err'; ?>">
            ニックネーム
            <input type="text" name="name" class="box-number" value="<?php echo getFormData('name'); ?>">
            <div class="area-msg">
              <?php 
            if(!empty($err_msg['name'])) echo $err_msg['name'];
            ?>
          </div>
        </label>
          <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
            Email
            <input type="text" name="email" class="box-number" value="<?php echo getFormData('email'); ?>">
            <div class="area-msg">
              <?php 
            if(!empty($err_msg['email'])) echo $err_msg['email'];
            ?>
          </div>
        </label>

        <div class="btn-container">
            <button type="submit" value="btn_confirm" class="btn btn-flat btn-flat-button">
                <span>編集する</span> 
            </button>
            </div>
        </form>
      </div>
    </section>
  </div>

<!-- サイドバー -->
<?php
require('sidebar.php');
?>

<!-- footer -->
<?php
require('footer.php'); 
?>
