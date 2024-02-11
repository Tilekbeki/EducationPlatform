<?php 
session_start();


require_once '../functions/db.php';
require_once '../functions/form/helper.php';
require_once '../templates/stylelink.php';
checkAuth();

$id = $_SESSION['user']['id'];
$select = "SELECT * FROM `user` WHERE id = '$id'";
    $query1 = mysqli_query($db,$select);
    $user = mysqli_fetch_assoc($query1);

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
                <div class="header__title">
                    <a href="/">Education platform</a>
                </div>
                <ul class="user__menu-desctop">
                    <li class="user__item"><a href="#">Topics</a></li>
                    <li class="user__item"><a href="#">Services and products</a></li>
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
    <div class="user__content">
    <div class="user__menu">asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd</div>
    <div class="content__body"><?php echo "Hello" . $user['name'] ?></div>
    </div>
</div>

</body>
</html>
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