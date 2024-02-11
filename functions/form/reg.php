<?php 
session_start();
require_once '../db.php';
require_once 'helper.php';


$name = trim(strip_tags($_POST['name'])) ?? null;
$surname = trim(strip_tags($_POST['surname'])) ?? null;
$email = trim(strip_tags($_POST['email'])) ?? null;
$password = trim(strip_tags($_POST['password'])) ?? null;
$repeatedPassword = trim(strip_tags($_POST['repeatedPassword'])) ?? null;

$_SESSION['validation'] = [];







if(empty($name)) {
    addValidationError('name', 'Wrong name');
} 

if(empty($surname)) {
    addValidationError('surname', 'Wrong surname');
} 

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addValidationError('email', 'Wrong email');
}

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $select = "SELECT `email` FROM `user` WHERE email = '$email'";
    $query1 = mysqli_query($db,$select);
    $gotEmail = mysqli_fetch_assoc($query1);
    $reapetedEmail = $gotEmail['email'];
    if ($reapetedEmail == $email) {
        addValidationError('email', 'person with these email already exist');
    }
    
}

if(empty($password)) {
    addValidationError('password', 'Empty password');
}

if(empty($repeatedPassword)) {
    addValidationError('emptypassword', 'Empty repeated password');
}

if($password !== $repeatedPassword) {
    addValidationError('password', 'Passwords are not equal');
}


if (!empty($_SESSION['validation'])) {
    addOldValue('name',$name);
    addOldValue('surname',$surname);
    addOldValue('email',$email);
    redirect('/EducationPlatform/auth/register.php');
}

$bcryptedPassword = password_hash($password, PASSWORD_BCRYPT);
$insert = "INSERT INTO user (`name`, `surname`, `email`, `password`, `isADMIN`) VALUES('$name', '$surname', '$email', '$bcryptedPassword', '0')";
 



try {
    if($name && $surname && $email && $password === $repeatedPassword && $password) {
        $query = mysqli_query($db,$insert);  
    }
    if($query) redirect('/EducationPlatform/auth/login.php');
} catch (\Exception $e) {
    die($e->getMessage());
}

?>