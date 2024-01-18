<?php 
session_start();


require_once '../functions/db.php';
require_once '../functions/form/helper.php';
checkAuth();
$id = $_SESSION['user']['id'];

setcookie('user',"$id", time() + 3600 * 24 * 7, '/');//установил куки

$select = "SELECT * FROM `user` WHERE id = '$id'";
    $query1 = mysqli_query($db,$select);
    $user = mysqli_fetch_assoc($query1);

?>


<h1>Hello <?php echo $user['name']; ?></h1>
<form action="../functions/form/logout.php" method="POST">
    <button role="button">LogOut</button>
</form>