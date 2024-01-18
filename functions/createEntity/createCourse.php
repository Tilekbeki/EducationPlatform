<?php
    require_once '../db.php';

    if (!empty($_POST)) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          $name = mysqli_real_escape_string($db,$_POST['name']);
          $description = mysqli_real_escape_string($db,$_POST['description']);
          $successTips = mysqli_real_escape_string($db,$_POST['successTips']);
          $subject = mysqli_real_escape_string($db,$_POST['subject']);
      
          $insert = "INSERT INTO course (`name`, `description`, `successTips`, `subject`) VALUES('$name', '$description', '$successTips', '$subject')";
      
          $query = mysqli_query($db,$insert);
      
          if ($query) header('Location: /EducationPlatform/index.php');
      }
?>