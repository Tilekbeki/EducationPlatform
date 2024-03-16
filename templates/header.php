<?php 
session_start();
// $link = '';
// function returnLink ($page) {
    

//     if ($page == "main") {
//         return $link = "/assets/css/style.css";
//     } elseif ($page == "another") {
//         return $link = "../assets/css/style.css";
//     }
// }

?>

<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="header__top-text">The more you decide, the smarter you become.🔥</div>
        </div>
    </div>
    <div class="header__main">
        <div class="container">
            <div class="header__wrap">
                <div class="logo">
                    <a href="/">Education platform</a>
                </div>
                <ul class="header__subjects">
                    <li><a href="/EducationPlatform/search/search.php">🔍</a></li>
                    <li><a href="#">Subjects</a></li>
                    <li><a href="#">About us</a></li>
                    <div class="header__auth">
                        <?php if(!isset($_COOKIE['token'])) { ?>
                            <a href="/EducationPlatform/auth/login.php">LogIn</a>
                        <?php } else {?>
                            <a href="/EducationPlatform/user/profile.php">Profile</a>
                            <?php } ?>
                        
                    </div>
                </ul>
                
            </div>
        </div>
    </div>

</header>
</body>
</html>