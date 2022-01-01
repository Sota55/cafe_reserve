
$(function() {

//spメニュー
  $('.js-toggle-sp-menu').on('click', function() {
    $(this).toggleClass('active');
    $('.js-toggle-sp-menu-target').toggleClass('active');
  });

  $('.slick01').slick({
        accessibility: false,
        fade: true,
        autoplay: true,
        infinite: true,
        dots: false,
        arrows: false,
        autoplaySpeed: 4000,
        speed: 5000,
  });
  
  function fadeAnime(){
  //fadein-trigger
  $('.fadeInUpTrigger').each(function(){
    var elemPos = $(this).offset().top-50;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if(scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeUp');
    }else{
      $(this).removeClass('fadeUp');
    }
  });
  }

  // 画面をスクロールをしたら動かしたい場合の記述
  $(window).scroll(function (){
    fadeAnime();/* アニメーション用の関数を呼ぶ*/
  });// ここまで画面をスクロールをしたら動かしたい場合の記述
  $("input[type='checkbox']").on('change', function(){                 //チェックボックス（type='checkbox'）の値が変更されたとき・・・
    cbv = $(this).val();                                               //クリックされたチェックボックスのvalue値を変数に格納
    if( $(this).prop('checked')){                                      //もしクリックされたチェックボックスがチェックされていたら・・・
      $("input:checkbox[value='" + cbv + "']").prop('checked',true);   //同じvalueを持つチェックボックスは全部チェックを入れる
    }else{
      $("input:checkbox[value='" + cbv + "']").prop('checked',false);  //逆にチェックが外れていたら全部チェックを外す。
    }
  });

  var $ftr = $('#footer');
  if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
    $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
  }
  
  // メッセージ表示
  var $jsShowMsg = $('#js-show-msg');
  var msg = $jsShowMsg.text();
  if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
    $jsShowMsg.slideToggle('slow');
    setTimeout(function(){ $jsShowMsg.slideToggle('slow'); }, 5000);
  }; 

});
