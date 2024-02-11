<?php
session_start();
require_once 'helper.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        unset($_SESSION['user']['id']);
        setcookie('user', '', time() - 3600, '/'); // устанавливаем куки на пустое значение и время жизни в прошлое
        redirect('/EducationPlatform/auth/login.php');
    } else {
        redirect('/EducationPlatform');
    }

?>