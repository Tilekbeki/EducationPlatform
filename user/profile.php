<?php 
session_start();

require_once '../functions/db.php';

require_once '../functions/form/helper.php';
require_once '../templates/stylelink.php';
checkAuth();
require '../vendor/autoload.php'; // Подключаем автозагрузчик Composer
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$token =$_COOKIE['token']; 
giveInfoByToken($token);
$info = giveInfoByToken($token);
$user_id = $info['user_id'];
$username = $info['username'];
$usersurname = $info['usersurname'];
$email = $info['email'];
$password = $info['password'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <title>Profile</title>
</head>
<body>
<div class="user">
    <nav class="navbar">
        <div class="container">
            <div class="user__wrapper">
                <div class="logo">
                    <a href="/">Education platform</a>
                </div>
                <ul class="user__menu-desctop">
                    <li class="user__item"><a href="?do=user_topics">My topics</a></li>
                    <li class="user__item"><a href="/">Subjects</a></li>
                    <li class="user__item"><a href="?do=user_profile">Profile</a></li>
                    <li class="user__item">
                        <form action="../functions/form/logout.php" method="POST">
                            <button class="user__item-logout" role="button">LogOut</button>
                        </form>
                    </li>
                </ul>
                <ul class="user__menu-mobile"></ul>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container">
            
            <div class="content-body">
            <?php 
                if (isset($_GET['do']) &&  $_GET['do'] == 'user_profile'){ ?>
                <h1 class="user-profile__title">Your profile</h1>
                    <div class="user-profile">
                        <div class="user-profile__name">
                            <p class="user-profile__subtitle">Name</p>
                            <p><?php echo $username ?></p>
                        </div>
                        <div class="user-profile__surname">
                            <p class="user-profile__subtitle">Surname</p>
                            <p><?php echo $usersurname ?></p>
                        </div>
                        <div class="user-profile__email">
                            <p class="user-profile__subtitle">Email</p>
                            <p><?php echo $email ?></p>
                        </div>
                        <a href="?do=update-profile" class="user-profile__button">UPDATE PROFILE</a>
                        
                    </div>
               <?php }
            ?>
            <?php
                if (!isset($_GET['do'])){ ?>
                    <div class="user-info">
                        <h1 class="user-info__greeting">Hello <?php echo $username ?></h1>
                        <p class="user-info__info">On this page, users can view a list of purchased 
                            Topics and click on them to access more information.<br> 
                            Additionally, they can update their profile information 
                            on the profile page and return to the overview of subjects on the main page.</p>
                    </div>
                <?php }
            ?>
                    
            <?php 
                if (isset($_GET['do']) &&  $_GET['do'] == 'user_topics'){ 
                    $select = "SELECT topic.name, topic.course FROM topic JOIN usertopic ON topic.name= usertopic.topic WHERE usertopic.id_user = $user_id";
                    $query1 = mysqli_query($db, $select);
                    $topics = mysqli_fetch_all($query1, MYSQLI_ASSOC); ?>
                   <h1 class="user-profile__title">Your Topics</h1>
                   <div class="user-topics">
                   <?php if ($query1) {
                    
                    foreach ($topics as $topic) {
                        # code...
                    
                    ?>
                    
                        <div class="topic">
                            <div class="topic__name">Topic: <?php echo $topic['name'] ?></div>
                            <div class="topic__course">Course: <?php echo $topic['course'] ?></div>
                            <!-- <div class="topic__subject">asdas</div> -->
                            <a href="/EducationPlatform/topic/topic.php?name=<?php echo $topic['name'] ?>" class="topic__link">GET STARTED</a>
                        </div>
               <?php } } }
            ?>

                <?php 
                if (isset($_GET['do']) &&  $_GET['do'] == 'update-profile'){?>
                    <h1 class="user-profile__title">Update Profile</h1>
                    <div class="user-profile">
                        <form action="">
                            <label for="">
                                <p class="user-profile__subtitle">Name</p>
                                <p><input type="text" value="<?php echo $username ?>"></p>
                            </label>
                            <label for="">
                                <p class="user-profile__subtitle" >Surname</p>
                                <p><input type="text" value="<?php echo $usersurname ?>"></p>
                            </label>
                            <label for="">
                                <p class="user-profile__subtitle">Email</p>
                                <p><input type="text" value="<?php echo $email ?>"></p>
                            </label>
                            <label for="">
                                <p class="user-profile__subtitle">Password</p>
                                <p><input type="text"></p>
                            </label>
                            <label for="">
                                <p class="user-profile__subtitle">New Password</p>
                                <p><input type="text"></p>
                            </label>
                            <button type="submit" class="user-profile__button">UPDATE PROFILE</button>
                        </form>
                    </div>
                 <?php } ?>

                </div>
                
            </div>
        </div>
    </div>
</div>

<?php 
        
        require_once "../templates/footer.php";
    ?>
<!-- Add your Sandbox API credentials
Client ID
AaT6ikYdyPuULkTYx6g9T-XK8T2X1t1nUr3fhiL0sc7XTNXkPOZlAfS8RICxWFgtyHMBiF9Owpus6TTN


Client secret
EILZNa4ANpYHS3oyzy-hNoa0X_XK16prhhj-jCPOqHAsWz_dODW9SvdFuMXbfkn21_ptLnBOkx4FbzIa


Manage API credentials -->



<!-- Card number
4032035760761833

Expiry date
Any
CVC code
Any -->




<!-- Email
sb-gfpto29437051@business.example.com

Password
;wGoC!1A

Type
Business -->

<!-- https://developer.paypal.com/dashboard/accounts/ -->


<!-- sb-vpwmr29441109@personal.example.com
RTBq/!8N -->