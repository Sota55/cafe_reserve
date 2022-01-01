<?php
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　予約詳細ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// 画面表示用データ取得
//================================
// 予約IDのGETパラメータを取得
$r_id = (!empty($_GET['r_id'])) ? $_GET['r_id'] : '';
// DBから予約データを取得
$viewData = getReserveOne($r_id);
// パラメータに不正な値が入っているかチェック
if(empty($viewData)){
  error_log('エラー発生:指定ページに不正な値が入りました');
  header("Location:mypage.php"); //マイページへ
}
debug('取得したDBデータ：'.print_r($viewData,true));

// post送信されていた場合
if(!empty($_POST['submit'])){
  debug('POST送信があります。');
  
  //ログイン認証
  require('auth.php');

  //例外処理
  try {
    // DBへ接続
    $dbh = dbConnect();
    // SQL文作成
    $sql = 'UPDATE reserve_info SET delete_flg = 1 WHERE id = :r_id';
    // データ流し込み
    $data = array(':r_id' => $_GET['r_id']);
    // クエリ実行
    $stmt = queryPost($dbh, $sql, $data);

    // クエリ成功の場合
    if($stmt){
      $_SESSION['msg_success'] = SUC03;
      debug('マイページへ遷移します。');
      header("Location:mypage.php"); //マイページへ
      return $_SESSION['msg_success'];
    }

  } catch (Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    $err_msg['common'] = MSG07;
  }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = '予約詳細';
require('head.php'); 
require('header.php'); 
?>

<body>

<!-- Main -->
<section class="container container-ornament container-body">
  <h2 class="container-title">
      <span class="sub-title sub-title-reserve">Reserve Detail</span>
      <span class="main-title main-title-reserve">予約の詳細</span>
  </h2>

<div class="container container-form">
        
    <div class="area-msg area-msg-notice">
      <?php 
      if(!empty($err_msg['common'])) echo $err_msg['common'];
      ?>
    </div>
        <div class="title">
          <span class="badge"><?php echo sanitize($viewData['reserve_date']); ?></span>
          <?php echo sanitize($viewData['reserve_time']); ?>
          <?php echo sanitize($viewData['member']).'名様'; ?>
        </div>
        <div class="reserve-detail">
          <p>お名前：<?php echo sanitize($viewData['username']); ?>[<?php echo sanitize($viewData['furigana']); ?>]様</p>
          <p>使用用途：<?php echo sanitize($viewData['reserve_use']); ?></p>
          <p>ご要望：<?php echo sanitize($viewData['request']); ?></p>
          <p>年齢：<?php (!empty($viewData['age']) ? sanitize($viewData['age']) : "") ; ?>歳</p>
          <p>電話番号：<?php echo sanitize($viewData['tel']); ?></p>
          <p>メールアドレス：<?php echo sanitize($viewData['email']); ?></p>
          <p>メールを受け取るか：<?php if($viewData['sendmail'] == 1) echo '受け取る'; else echo '受け取らない'; ?></p>
          <p>予約した時間：<?php echo sanitize($viewData['create_date']); ?></p>
        </div>
        <div class="reserve-delete">
          <div class="item-left">
            <a href="mypage.php<?php echo appendGetParam(array('p_id')); ?>">&lt; マイページに戻る</a>
          </div>
          <form action="" method="post">
            <div class="item-right">
              <input type="submit" value="この予約を削除する" name="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
  </div>
</section>


    <!-- footer -->
    <?php
    require('footer.php'); 
    ?>
