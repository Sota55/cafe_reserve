<?php 
$siteTitle = 'トップページ';
require('head.php');
require('header.php');
?>

<body>
    <div class="slider-wrap js-float-menu-target fadeDown">
        <div class="slider">
            
            <ul class="slick01">
                <li>
                    <img src="dist/img/coffeeshop.jpg" alt="">
                    <div class="area area-shop">
                        <p class="sentence sentence-shop">ゆったりとくつろげる場所を提供します</p>
                    </div>
                </li>
                <li>
                    <img src="dist/img/coffeebean.jpg" alt="">
                    <div class="area area-bean">
                        <p class="sentence sentence-bean">一杯ずつエスプレッソを抽出します</p>
                    </div>
                </li>
                <li>
                    <img src="dist/img/glassbeer.jpg" alt="">
                    <div class="area area-beer">
                        <p class="sentence sentence-beer">たまには自分へのご褒美を</p>
                    </div>
                </li>
            </ul>
            
        </div>
    </div>

    <section class="container container-ornament container-body fadeInUpTrigger" id="news">
        <h2 class="container-title">
            <span class="sub-title sub-title-news">News</span>
            <span class="main-title">お知らせ</span>
        </h2>
        <div class="news-wrap">
          <ul class="news">
            <li class="news-item">
              <a class="news-link" href="">
                <span class="news-date">2021.12.31</span>
                <span class="news-title">新しいチョコケーキができました。</span>
              </a>
            </li>
            <li class="news-item">
              <a class="news-link" href="">
                <span class="news-date">2021.09.31</span>
                <span class="news-title">電子決済に対応しました。</span>
              </a>
            </li>
            <li class="news-item">
              <a class="news-link" href="">
                <span class="news-date">2021.04.15</span>
                <span class="news-title">GWのお店の定休日</span>
              </a>
            </li>
          </ul>
        </div>
    </section>
        

    <section class="container container-ornament container-body fadeInUpTrigger" id="about">
        <h2 class="container-title">
            <span class="sub-title sub-title-about">About</span>
            <span class="main-title">カフェアンドバーに<br>ついて</span>
        </h2>
            <p class="about">

                当店は埼玉県にある小さなカフェアンドバーです。
                広い席で女子会、作業しているサラリーマンなどたくさんの人で溢れています。
                コーヒーを飲んで食後のリラックスを楽しんでいる人や、昼間からお酒を飲んでいる人もいたりと、
                様々なシーンでご利用いただけます。
                夜には照明を落とし、静かな空間で一人飲みをすることもできます。
                また、友達を呼んでわいわい盛り上がったり、なんてこともできます。
                自分のご褒美に、ぜひお店でお待ちしています。
                <br>（土日は混雑してしまうため、早めの予約をおすすめします。）
                
            </p>
            <div class="btn-container">
                <a href="reserve.php" class="btn btn-flat" ontouchstart=""><span>ご予約はこちらから</span></a>
            </div>
        </section>


    <section class="container container-ornament container-body fadeInUpTrigger" id="recommend">
        <h2 class="container-title">
            <span class="sub-title sub-title-recommend">Recommend</span>
            <span class="main-title">おすすめの商品</span>
        </h2>

        <div class="recommend-wrap">

            <div class="recommend recommend-bread-wrap container">
                <div class="recommend-pic recommend-pic-bread">
                    <div class="recommend-sentence recommend-sentence-bread">
                        <h1 class="recommend-sentence-title">こだわりのパン</h1>
                        <p>

                        当店で扱っているパンは全て地元のパン屋から仕入れています。
                        そのパンをバルミューダのトースターを使って焼き上げています。
                        そのため、感動の香りと食感には自信があります。
                        
                        </p>
                    </div>
                </div>
            </div>
                
            <div class="recommend recommend-coffee-wrap container fadeInUpTrigger">
                <div class="recommend-pic recommend-pic-coffee">
                    <div class="recommend-sentence recommend-sentence-coffee">
                    <h1 class="recommend-sentence-title">豆からつくる<br>自慢のコーヒー</h1>
                        <p>

                        私たちは一杯ずつ丁寧にコーヒーをおつくりします。引き立ての豆を焙煎しエスプレッソを抽出します。
                        コロンビア産の珍しい豆を使っていて、キリッとした苦味が甘いものととても合います。
                        また、ミルクと混ぜてカフェラテにするのもおすすめです。
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
                    
    </section>

    <section class="container container-ornament container-body fadeInUpTrigger" id="shop">
            <h2 class="container-title">
                <span class="sub-title sub-title-shop">Shop</span>
                <span class="main-title">店舗について</span>
            </h2>

            <div class="shop shop-wrap">
                <div class="shop-info">
                    <table class="shop-table">
                        <tbody>
                            <tr class="short">
                                <td class="noborder">店舗</td>
                                <td class="noborder">Cafe & Bar（カフェアンドバー）</td>
                            </tr>
                            <tr class="address">
                                <td>住所</td>
                                <td>〒000-0000<br>
                                    埼玉県xxxxxxxxxxxxxx</td>
                            </tr>
                            <tr>
                                <td>電話番号</td>
                                <td class>xxx-xxxx-xxxx</td>
                            </tr>
                            <tr class="short">
                                <td>営業時間</td>
                                <td>11：00〜23：00（L.O.22：00）</td>
                            </tr>
                            <tr>
                                <td>定休日</td>
                                <td>不定休</td>
                            </tr>
                            <tr>
                                <td>アクセス</td>
                                <td>JRxx駅北口より徒歩10分</td>
                            </tr>
                            <tr class="short">
                                <td>クレジットカード</td>
                                <td>可（VISA,JCB）</td>
                            </tr>
                            <tr>
                            <td>電子マネー</td>
                                <td>可（PayPay）</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="shop-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d413151.36381948716!2d139.20813296404594!3d36.00209607033895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60192a8d477b01e9%3A0xfed91267aa80526c!2z5Z-8546J55yM!5e0!3m2!1sja!2sjp!4v1629525808887!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="btn-container">
                <a href="reserve.php" class="btn btn-flat"><span>ご予約はこちらから</span></a>
            </div>
        </section>
    
    <?php
    require('footer.php');
    ?>