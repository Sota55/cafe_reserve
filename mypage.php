<?php
//共通変数・関数ファイルを読込み
require('function.php');

//エラー出力強制
ini_set('display_errors',1);
//すべてのエラー表示
error_reporting(E_ALL);

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「 マイページ 」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();
reservePassed();

//ログイン認証
require('auth.php');


// 画面表示用データ取得
//================================
// カレントページのGETパラメータを取得
$currentPageNum = (!empty($_GET['p'])) ? $_GET['p'] : 1; //デフォルトは１ページめ
// ソート順
$sort = (!empty($_GET['sort'])) ? $_GET['sort'] : '';
// パラメータに不正な値が入っているかチェック
if(!is_int((int)$currentPageNum)){
  error_log('エラー発生:指定ページに不正な値が入りました');
  header("Location:logout.php"); //ログアウトする
}
// 表示件数
$listSpan = 10;
// 現在の表示レコード先頭を算出
$currentMinNum = (($currentPageNum-1)*$listSpan); //1ページ目なら(1-1)*10 = 0 、 ２ページ目なら(2-1)*10 = 10
// DBから予約データを取得
$dbReserveData = getReserveList($currentMinNum, $sort);
debug('現在のページ：'.$currentPageNum);
//debug('フォーム用DBデータ：'.print_r($dbFormData,true));

debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
    //例外処理
    try {
        // DBへ接続
        $dbh = dbConnect();
        // SQL文作成
        $sql = 'SELECT name FROM shop WHERE id = :id';
        $data = array(':id' => $_SESSION['user_id'],);
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // クエリ成功の場合
        if($stmt){
            debug('print_r($stmt)'.print_r($result,true));
        }
      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $err_msg['common'] = MSG07;
      }
  debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>


<?php
$siteTitle = 'マイページ';
require('head.php'); 
require('header.php'); 
?>

<!-- Main -->
<p id="js-show-msg" class="msg-slide">
    <?php echo getSessionFlash('msg_success'); ?>
</p>
<body>
<section class="container container-ornament container-body">
    <h2 class="container-title">
        <span class="sub-title sub-title-reserve">Mypage</span>
        <span class="main-title main-title-reserve">マイページ</span>
    </h2>
    
    <div class="container-form">
      <div class="area-msg area-msg-notice">
        <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
      </div>
      <p><?php echo $result['name']; ?>さんこんにちは。今日も頑張りましょう。</p>

      <div class="title-box">
        <h2 class="title container-reserve">予約情報</h2>
      </div>
    </div>
    
    <div class="search-title">
        <div class="search-left">
          <span class="total-num"><?php echo sanitize($dbReserveData['total']); ?></span>件の予約が見つかりました
        </div>
        <div class="search-right">
          <span class="num"><?php echo (!empty($dbReserveData['data'])) ? $currentMinNum+1 : 0; ?></span> - <span class="num"><?php echo $currentMinNum+count($dbReserveData['data']); ?></span>件 / <span class="num"><?php echo sanitize($dbReserveData['total']); ?></span>件中
        </div>
    </div>
    <div class="panel-list">
      <?php foreach($dbReserveData['data'] as $key => $val): ?>
        <a href="reserveDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&r_id='.$val['id'] : '?r_id='.$val['id']; ?>" class="panel">
          <div class="panel-head">
            <?php echo $val['reserve_date'].'：'.$val['reserve_time'].'から'.$val['username'].'['.$val['furigana'].']様'.$val['member'].'名様'; ?>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
      
    <?php pagination($currentPageNum, $dbReserveData['total_page'], '&sort='.$sort); ?>
      
</section>

<!-- サイドバー -->
<?php
    require('sidebar.php');
    require('footer.php');
?>
