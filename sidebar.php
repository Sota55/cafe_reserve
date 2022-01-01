  <!-- サイドバー -->
  <section id="sidebar">
  <?php if(!empty($dbReserveData['data'])){ ?>
    <form method="get">
      <h1 class="title">表示順</h1>
      <div class="selectbox">
        <span class="icn_select"></span>
        <select name="sort">
          <option value="0" <?php if(getFormData('sort',true) == 0){ echo 'selected'; } ?> >選択してください</option>
          <option value="1" <?php if(getFormData('sort',true) == 1){ echo 'selected'; } ?> >予約が近い順</option>
          <option value="2" <?php if(getFormData('sort',true) == 2){ echo 'selected'; } ?> >予約が遠い順</option>
        </select>
      </div>
      <input type="submit" value="検索">
    </form>
    <?php } ?>
    <div class="sidebar_menu">

      <a href="mypage.php">マイページ</a>
      <a href="profEdit.php">プロフィール編集</a>
      <a href="passEdit.php">パスワード変更</a>
      <a href="withdraw.php">退会</a>
    </div>
    </section>