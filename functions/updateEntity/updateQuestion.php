<?php
require_once '../db.php';

if (!empty($_POST)) {
    $id = trim(strip_tags($_POST['QuestionId'])) ?? null;
    $title = trim(strip_tags($_POST['QuestionTitle'])) ?? null;
    $questionImgg = mysqli_real_escape_string($db,file_get_contents($_FILES['QuestionImgg']['tmp_name'])) ?? null;
    $metaKeywords = trim(strip_tags($_POST['QuestionMetaKeywords'])) ?? null;
    $metaDescription = trim(strip_tags($_POST['QuestionMetaDescription'])) ?? null;
    if (empty($_FILES['QuestionImgg']['tmp_name']) || empty($_FILES['AnswerImgg']['tmp_name'])) {
      echo "пусто";
     }
    if ($title && $questionImgg) {
        
        $update = "UPDATE `question` SET `imgQuestion`='$questionImgg',`title`='$title' , `metaKeywords`='$metaKeywords', `metaDescription`= '$metaDescription' WHERE id = '$id'";

        $query = mysqli_query($db,$update);

        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=questions');
       
      
          
      }
}
?>