<?php
require_once '../db.php';

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST['name'])) ?? null;
    $surname = trim(strip_tags($_POST['surname'])) ?? null;
    $email =trim(strip_tags($_POST['email'])) ?? null;
    $oldemail = trim(strip_tags($_POST['oldEmail'])) ?? null;
    $password = trim(strip_tags($_POST['password'])) ?? null;
    $token = trim(strip_tags($_POST['token'])) ?? null;
    // Проверяем каждое поле перед выполнением запроса
    
        $update = "UPDATE `user` SET `name`='$name',`surname`='$surname',`email`='$email',`password`='$password',`isADMIN`='0',`reset_token`='$token' WHERE email = '$oldemail'";
        $query = mysqli_query($db, $update);
        if ($query) {
            header('Location: /EducationPlatform/admin/admin.php?do=courses');
        }
    
}
?>