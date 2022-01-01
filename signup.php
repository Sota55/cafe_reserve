
<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　スタッフ登録ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


error_reporting(E_ALL);
ini_set('display_errors','On');

//post送信されていた場合
if(!empty($_POST)){

  //変数にユーザー情報を代入
  $shopname = $_POST['shopname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_re = $_POST['pass_re'];

  //未入力チェック
  validRequired($shopname, 'shopname');
  validRequired($email, 'email');
  validRequired($pass, 'pass');
  validRequired($pass_re, 'pass_re');

  if(empty($err_msg)){


    //shop_nameの最大文字数チェック
    validMaxLen($shopname, 'shopname');

    //emailの形式チェック
    validEmail($email, 'email');
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    //email重複チェック
    validEmailDup($email);

    //パスワードチェック（半角英数字、最大文字数、最小文字数）
    validPass($pass, 'pass');

    //パスワード（再入力）の最大文字数チェック
    validMaxLen($pass_re, 'pass_re');
    //パスワード（再入力）の最小文字数チェック
    validMinLen($pass_re, 'pass_re');

    if(empty($err_msg)){

      //パスワードとパスワード再入力が合っているかチェック
      validMatch($pass, $pass_re, 'pass_re');

      if(empty($err_msg)){

        //例外処理
        try {
          // DBへ接続
          $dbh = dbConnect();
          // SQL文作成
          $sql = 'INSERT INTO shop (name,email,password,create_date,update_date) VALUES(:name,:email,:pass,:create_date,:update_date)';
          $data = array(':name' => $shopname, ':email' => $email, ':pass' => password_hash($pass, PASSWORD_DEFAULT),
                        ':create_date' => date('Y-m-d H:i:s'),
                        ':update_date' => date('Y-m-d H:i:s'));
          // クエリ実行
          $stmt = queryPost($dbh, $sql, $data);
          
          // クエリ成功の場合
          if($stmt){
            //ログイン有効期限（デフォルトを１時間とする）
            $sesLimit = 60*60;
            // 最終ログイン日時を現在日時に
            $_SESSION['login_date'] = time();
            $_SESSION['login_limit'] = $sesLimit;
            // ユーザーIDを格納
            $_SESSION['user_id'] = $dbh->lastInsertId();

            debug('セッション変数の中身：'.print_r($_SESSION,true));

            header("Location:mypage.php"); //マイページへ
          }

        } catch (Exception $e) {
          error_log('エラー発生:' . $e->getMessage());
          $err_msg['common'] = MSG07;
        }

      }
    }
  }
}
?>
<?php
  $siteTitle = 'スタッフ登録';
  require('head.php'); 
  require('header.php');
?>


<body>
    
<!-- Main -->
<section class="container container-ornament container-body" >
  <h2 class="container-title">
      <span class="sub-title sub-title-reserve">Sign UP</span>
      <span class="main-title main-title-reserve">スタッフを登録する</span>
  </h2>

  <div class="container container-form">

    <form action="" method="post" class="reserve-form">
    <div class="container-reserve">
        <div class="title-box">
            <h2 class="title container-reserve">スタッフ情報</h2>
        </div>

        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['shopname'])) echo 'err'; ?>">
            ニックネーム
            <span class="badge">必須</span>
            <input class="box-number" type="text" name="shopname" value="<?php if(!empty($_POST['shopname'])) echo $_POST['shopname']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['shopname'])) echo $err_msg['shopname'];  ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
            email
            <span class="badge">必須</span>
            <input class="box-number" type="email" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass'])) echo 'err'; ?>">
            パスワード
            <span class="badge">必須</span>
            <input class="box-number" type="password" name="pass" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['pass_re'])) echo 'err'; ?>">
            パスワード再入力
            <span class="badge">必須</span>
            <input class="box-number" type="password" name="pass_re" value="<?php if(!empty($_POST['pass_re'])) echo $_POST['pass_re']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['pass_re']))  echo $err_msg['pass_re'];  ?>
            </div>
        </label>
                
        <div class="btn-container">
            <button type="submit" name="btn_confirm" value="btn_confirm" class="btn btn-flat btn-flat-button">
                <span>登録する</span> 
            </button>
        </div>
    </div>
    </form>

  </div>
</section>

<?php
require('footer.php');
?>

