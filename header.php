<header class="header js-float-menu container-body">
    <h1 class="title"><a href="index.php">Cafe and Bar</a></h1>
    
        
    <div class="menu-trigger js-toggle-sp-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
        <nav class="nav-menu js-toggle-sp-menu-target">

            <ul class="menu">
            <?php
          if(empty($_SESSION['user_id'])){
        ?>
                <li class="menu-item"><a href="index.php" class="menu-link">Top</a></li>
                <li class="menu-item"><a href="#news" class="menu-link">News</a></li>
                <li class="menu-item"><a href="#about" class="menu-link">About</a></li>
                <li class="menu-item"><a href="#recommend" class="menu-link">Recommend</a></li>
                <li class="menu-item"><a href="#shop" class="menu-link">Shop</a></li>
                <li class="menu-item"><a href="reserve.php" class="menu-link">Reserve</a></li>
                <?php
          }else{
        ?>
                <li class="menu-item"><a href="mypage.php" class="menu-link">Mypage</a></li>
                <li class="menu-item"><a href="signup.php" class="menu-link">SignUp</a></li>
                <li class="menu-item"><a href="login.php" class="menu-link">Login</a></li>
                <li class="menu-item"><a href="logout.php" class="menu-link">LogOut</a></li>
<?php
          }
        ?>
            </ul>
        </nav>
</header>