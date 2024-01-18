<?php
    require_once '../db.php';

    if (!empty($_POST)) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          $name = mysqli_real_escape_string($db,$_POST['name']);
          // $email = mysqli_real_escape_string($db,$_POST['email']);
          // $date = mysqli_real_escape_string($db,$_POST['date']);
      
          $insert = "INSERT INTO subject (`name`) VALUES('$name')";
      
          $query = mysqli_query($db,$insert);
      
          if ($query) header('Location: /EducationPlatform/index.php');
      }
?>