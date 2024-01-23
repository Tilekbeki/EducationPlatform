<?php 
session_start();
require_once '../db.php';
require_once 'helper.php';

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;


if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addOldValue('email', $email);
    addValidationError('email', 'Wrong email');
    setMessage('error', 'Validation error');
    redirect('/auth/login.php');
}

if (empty($password)) {
    addValidationError('password', 'Empty password');
    setMessage('error', 'empty password');
    redirect('/auth/login.php');
}

if ($email && $password) {
    $select = "SELECT * FROM `user` WHERE email = '$email'";
    $query1 = mysqli_query($db,$select);
    $user = mysqli_fetch_assoc($query1);

    if(!$user) {
        setMessage("error", "user $email not found");
        redirect('/auth/login.php');
        validationErrorAttr('email');
    } else {//нашелся пользователь с имейлом теперь проверка пароля
        if(!password_verify($password, $user['password'])) {
            setMessage("error", "Wrong login or password");
        } else {
            $id = $user['id'];
            $_SESSION['user']['id'] = $id;
            setcookie('user',"22", time()+60*60*7);//
            redirect('/user/profile.php');
        }
    }

}