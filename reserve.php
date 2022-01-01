<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「 予約フォーム ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


error_reporting(E_ALL);
ini_set('display_errors','On');

// 変数の初期化
$page_flag = 0;

//post送信されていた場合
if(!empty($_POST)){

  //変数にユーザー情報を代入
  $member = $_POST['member'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  $use = $_POST['use'];
  $request = $_POST['request'];
  $username = $_POST['username'];
  $furigana = $_POST['furigana'];
  $age = (!empty($_POST['age'])) ? $_POST['age'] : 0;
  $tel = $_POST['tel'];
  $email = $_POST['email'];
  
  $notice = (!empty($_POST['notice'])) ? $_POST['notice'] : 0;
  $sendmail = (!empty($_POST['sendmail'])) ? $_POST['sendmail'] : 0;
  $policy = (!empty($_POST['policy'])) ? $_POST['policy'] : 0;

  //未入力チェック
  validRequired($member, 'member');
  validRequired($date, 'date');
  validRequired($time, 'time');
  validRequired($username, 'username');
  validRequired($furigana, 'furigana');
  validRequired($tel, 'tel');
  validRequired($email, 'email');
  
  if(empty($err_msg)) {
          
    //要望欄の最大文字数チェック
    validMaxLen($request, 'request');
    
    //名前の最大文字数チェック
    validMaxLen($username, 'username');
    
    //フリガナの最大文字数チェック
    validMaxLen($furigana, 'furigana');
    
    //emailの形式チェック
    validEmail($email, 'email');
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    
    //電話番号の半角英数字チェック
    validHalf($tel, 'tel');
    //電話番号の形式チェック
    validTel($tel, 'tel');
    
    //ポリシーに同意されているかチェック
    validCheck($notice, $policy, 'notice');
          
    if(!empty($age)) { //値が入っていた場合のみチェックする
    //年齢の最大文字数チェック
    validMaxLen($age, 'age');
    //年齢の半角数字チェック
    validNumber($age, 'age');
    }
    }
}


if(!empty($_POST['btn_confirm'])){
    
    if(empty($err_msg)) {
        $page_flag = 1;
    }
} elseif(!empty($_POST['btn_submit']) ) {
	$page_flag = 2;
}
?>


<?php
  $siteTitle = '予約ページ';
  require('head.php'); 
  require('header.php'); 
?>

<body>
    
    <!-- Main -->
    <section class="container container-ornament container-body" >
        <h2 class="container-title">
            <span class="sub-title sub-title-reserve">Reserve</span>
            <span class="main-title main-title-reserve">予約する</span>
        </h2>
        <?php if( $page_flag === 1 ): ?>
            
        <section class="container container-ornament container-body" >
        <form action="" method="post">
        <div class="container-reserve">
        <div class="title-box">
            <h2 class="title container-reserve">予約者情報</h2>
        </div>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '人数：'.$_POST['member'].'人'; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '日にち：'.$_POST['date']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '時間：'.$_POST['time']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '用途：'.$_POST['use']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo 'ご要望欄：'.$_POST['request']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo 'お名前：'.$_POST['username']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo 'フリガナ：'.$_POST['furigana']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '年齢：'.$_POST['age'].'歳'; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo '電話番号：'.$_POST['tel']; ?></p>
        </label>
        <label class="reserve-form-item reserve-form-item-info">
            <p><?php echo 'email：'.$_POST['email']; ?></p>
        </label>
        <div class="policy">
        <label>
            <p><?php echo '「お店からのお知らせ」に同意する：'; if($notice == "") echo '同意しない'; else echo '同意する'; ?></p>
        </label>
        <label>
            <p><?php echo 'お店からのお得情報：'; if($sendmail == 1) echo '受け取る'; else echo '受け取らない'; ?></p>
        </label>
        <label>
            <p><?php echo '「利用規約」と「プライバシーポリシー」に同意する：'; if($policy == "") echo'同意しない'; else echo '同意する';?></p>
        </label>
        </div>

        <input type="submit" name="btn_back" value="戻る">
        <input type="submit" name="btn_submit" value="送信">
        <input type="hidden" name="member" value="<?php echo $_POST['member']; ?>">
        <input type="hidden" name="date" value="<?php echo $_POST['date']; ?>">
        <input type="hidden" name="time" value="<?php echo $_POST['time']; ?>">
        <input type="hidden" name="use" value="<?php echo $_POST['use']; ?>">
        <input type="hidden" name="request" value="<?php echo $_POST['request']; ?>">
        <input type="hidden" name="username" value="<?php echo $_POST['username']; ?>">
        <input type="hidden" name="furigana" value="<?php echo $_POST['furigana']; ?>">
        <input type="hidden" name="age" value="<?php echo $_POST['age']; ?>">
        <input type="hidden" name="tel" value="<?php echo $_POST['tel']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
        <input type="hidden" name="sendmail" value="<?php if(!empty($_POST['sendmail'])) echo $_POST['sendmail']; ?>">
        </form>
        </section>
    <?php elseif( $page_flag === 2 ): ?>
        <?php 
            //例外処理
            try {
                $dbh = dbConnect();
                //SQL文作成
                $sql = 'INSERT INTO reserve_info (member,reserve_date,reserve_time,reserve_use,request,username,furigana,age,tel,email,sendmail,create_date,update_date)
                VALUES(:member,:reserve_date,:reserve_time,:reserve_use,:request,:username,:furigana,:age,:tel,:email,:sendmail,:create_date,:update_date)';
                $data = array(':member' => $member, ':reserve_date' => $date, ':reserve_time' => $time, ':reserve_use' => $use, ':request' => $request, ':username' => $username,':furigana' => $furigana, ':age' => $age, ':tel' => $tel, ':email' => $email, ':sendmail' => $sendmail, ':create_date' => date('Y-m-d H:i:s'), ':update_date' => date('Y-m-d H:i:s'));
                //クエリ実行
                queryPost($dbh, $sql, $data);
                 // クエリ成功の場合
                $err_msg['common'] = SUC05;
            } catch (Exception $e) {
                error_log('エラー発生:' . $e->getMessage());
                $err_msg['common'] = MSG07;
            }
?>

<div class="area-msg">
    <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
</div>

    <?php else: ?>
    <div class="container container-form">
        <div class="title-box">
            <h2 class="title">お店からのお知らせ</h2>
        </div>
        <div class="area-msg area-msg-notice">
                <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
        </div>
        <div class="shop-notice">
            <p>
                お食事会の用途（誕生日、接待など）や、食べ物アレルギーなどをお知らせください。
                <br>お席のご指定につきましては、ご要望に添えない場合もございますので、予めご了承ください。
                
                <br><br>★主役のお客様の思い出に★
                <br>誕生日、記念日、歓送迎会、打ち上げ等もお手伝いさせていただきます。
                <br>デザートプレートにメッセージを添えたり、サプライズも可能です。お気軽にご要望欄へお書き入れください。
                
            </p>
            <label class="message"> 
            <input type="checkbox" class="message" name="notice" value="notice" 
            <?php if(!empty($_POST['notice'])) echo 'checked'; ?>>
            「お店からのお知らせ」を読み、<br>内容を理解して同意する
            </input>
            </label>
        </div>


        <form action="" method="post" class="reserve-form">
        <div class="reserve-info">

        <label class="reserve-form-item <?php if(!empty($err_msg['member'])) echo 'err'; ?>">
            ご利用人数
            <select name="member" class="box-number">
            <option><?php if(!empty($_POST['member'])) echo $_POST['member']; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            </select>
            <div class="area-msg">
                <?php if(!empty($err_msg['member'])) echo $err_msg['member'];?>
            </div>
        </label>

        <label class="reserve-form-item <?php if(!empty($err_msg['date'])) echo 'err'; ?>">
            日付
            <input type="date" name="date" class="box-number box-number-date" 
            value="<?php if(!empty($_POST['date'])) echo $_POST['date']; ?>">
            
            <div class="area-msg">
                <?php if(!empty($err_msg['date'])) echo $err_msg['date']; ?>
            </div>
        </label>
    
        <label class="reserve-form-item <?php if(!empty($err_msg['time'])) echo 'err'; ?>">
            時間
            <select name="time" class="box-number">
                <option><?php if(!empty($_POST['time'])) echo $_POST['time']; ?></option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
            </select>
            <div class="area-msg">
                <?php if(!empty($err_msg['time'])) echo $err_msg['time']; ?>
            </div>
        </label>
        </div>
                
    <div class="container-reserve">
        <div class="title-box">
        <h2 class="title">ご要望</h2>
        </div>
        <div class="request-wrap">
            <label class="reserve-form-item reserve-form-item-use <?php if(!empty($err_msg['use'])) echo 'err'; ?>">
                <span>用途</span> 
                <select name="use" class="box-number <?php if(!empty($err_msg['use'])) echo 'err'; ?>">
                    <option><?php if(!empty($_POST['use'])) echo $_POST['use']; ?></option>
                    <option value="誕生日">誕生日</option>
                    <option value="友達との食事">友達との食事</option>
                    <option value="女子会">女子会</option>
                    <option value="忘新年会">忘新年会</option>
                    <option value="家族との食事">家族との食事</option>
                    <option value="お祝い">お祝い</option>
                    <option value="デート">デート</option>
                    <option value="接待">接待</option>
                    <option value="その他">その他</option>
                </select>
            </label>
                
            <label class="reserve-form-item reserve-form-item-text">
                <span>ご要望欄</span>
                <textarea name="request" placeholder="255文字以内でお書きください。" value="" maxlength="255" cols="30" rows="3" class="<?php if(!empty($err_msg['request'])) echo 'err err-textarea'; ?>"><?php if(!empty($_POST['request'])) echo $_POST['request']; ?></textarea>
                
                <div class="area-msg text">
                    <?php if(!empty($err_msg['request'])) echo $err_msg['request']; ?>
                </div>
            </label>
        </div>
    </div>
                

    <div class="container-reserve">
        <div class="title-box">
            <h2 class="title container-reserve">予約者情報</h2>
        </div>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['username'])) echo 'err'; ?>">
            名前
            <span class="badge">必須</span>
            <input placeholder="カフェ太郎" class="box-number" type="text" name="username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['username'])) echo $err_msg['username'];  ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['furigana'])) echo 'err'; ?>">
            フリガナ
            <span class="badge">必須</span>
            <input placeholder="カフェタロウ" class="box-number" type="text" name="furigana" value="<?php if(!empty($_POST['furigana'])) echo $_POST['furigana']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['furigana'])) echo $err_msg['furigana']; ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['age'])) echo 'err'; ?>">
            年齢
            <input placeholder="数字のみ入力" class="box-number" type="number" name="age" value="<?php if(!empty($_POST['age'])) echo $_POST['age']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['age']))  echo $err_msg['age'];  ?>
            </div>
        </label>
        <label class="reserve-form-item reserve-form-item-info <?php if(!empty($err_msg['tel'])) echo 'err'; ?>">
            電話番号
            <span class="badge">必須</span>
            <input placeholder="数字のみ入力" class="box-number" type="tel" name="tel" value="<?php if(!empty($_POST['tel'])) echo $_POST['tel']; ?>">
            <div class="area-msg">
                <?php if(!empty($err_msg['tel'])) echo $err_msg['tel']; ?>
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
        <div class="policy">
            <label>
                <input type="checkbox" name="notice" value="notice" <?php if(!empty($_POST['notice'])) echo 'checked'; ?>>「お店からのお知らせ」を読み、内容を理解して同意する
            </label>
            <br>
            <label>
                <input type="checkbox" name="sendmail" value="1" <?php if(!empty($_POST['sendmail'])) echo 'checked'; ?>>お店からお得情報を受け取る
            </label>
            <br>
            <label>
                <input type="checkbox" name="policy" class="rule" value=policy <?php if(!empty($_POST['policy'])) echo 'checked'; ?>>
                「<a href="">利用規約</a>」と「<a href="">プライバシーポリシー</a>」を確認し同意する
            </label>
            <div class="area-msg area-msg-policy">
                <?php if(!empty($err_msg['notice'])) echo $err_msg['notice']; ?>
            </div>
        </div>
                
        <div class="btn-container">
            <button type="submit" name="btn_confirm" value="btn_confirm" class="btn btn-flat btn-flat-button">
                <span>確認する</span> 
            </button>
            <span class="notsuc">※まだ予約は完了していません。</span>
        </div>
    </div>
    </form>

    <?php endif; ?>
</div>
</section>

<?php
require('footer.php');
?>