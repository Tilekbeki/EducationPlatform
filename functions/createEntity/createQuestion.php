<?php
    require_once '../db.php';

    if (!empty($_POST) and !empty($_FILES['imgQuestion']['tmp_name']) and !empty($_FILES['imgAnswer']['tmp_name'])) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          $title = mysqli_real_escape_string($db,$_POST['title']);
          $questionImg = mysqli_real_escape_string($db,file_get_contents($_FILES['imgQuestion']['tmp_name']));
          $answerImg = mysqli_real_escape_string($db,file_get_contents($_FILES['imgAnswer']['tmp_name']));
          $subtopic = mysqli_real_escape_string($db,$_POST['subtopic']);

          $insertInQuestion = "INSERT INTO question (`imgQuestion`, `imgAnswer`, `subTopic`, `title`) VALUES('$questionImg', '$answerImg', '$subtopic', '$title')";
        //   $select = "SELECT `id` FROM `question` WHERE `title` = '$title'";
          
          
          $query = mysqli_query($db,$insertInQuestion);
            
        //   echo $subtopic;
        if ($query) header("Location: /EducationPlatform/admin/admin.php?title=$title&subtopic=$subtopic"); 
            
      }



