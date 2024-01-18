<?php
    require_once '../db.php';

    if (!empty($_POST)) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          $name = mysqli_real_escape_string($db,$_POST['name']);
          $description = mysqli_real_escape_string($db,$_POST['description']);
          $topic = mysqli_real_escape_string($db,$_POST['topic']);
            
          $insert = "INSERT INTO subtopic (`name`, `description`, `topic`) VALUES('$name', '$description', '$topic')";
      
          $query = mysqli_query($db,$insert);
      
          if ($query) header('Location: /EducationPlatform/index.php');
      }
?>