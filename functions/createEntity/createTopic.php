<?php
    require_once '../db.php';

    if (!empty($_POST)) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          $name = mysqli_real_escape_string($db,$_POST['name']);
          $price = mysqli_real_escape_string($db,$_POST['price']);
          $price = (int) $price;
          $course = mysqli_real_escape_string($db,$_POST['course']);
      
          $insert = "INSERT INTO topic (`name`, `price`, `course`) VALUES('$name', '$price', '$course')";
      
          $query = mysqli_query($db,$insert);
      
          if ($query) header('Location: /EducationPlatform/index.php');
      }
?>