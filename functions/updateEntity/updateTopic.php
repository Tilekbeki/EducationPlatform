<?php
require_once '../db.php';

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST['TopicName'])) ?? null;
    $oldName = trim(strip_tags($_POST['OldTopicName'])) ?? null;
    $price =trim(strip_tags($_POST['TopicPrice'])) ?? null;
    $price = (int) $price;
    $metaKeywords = trim(strip_tags($_POST['TopicMetaKeywords'])) ?? null;
    $metaDescription = trim(strip_tags($_POST['TopicMetaDescription'])) ?? null;
    if ($name && $price>=0) {
        
        $update = "UPDATE `topic` SET `name`='$name',`price`='$price', `metaKeywords`='$metaKeywords', `metaDescription`= '$metaDescription' WHERE name = '$oldName'";

        $query = mysqli_query($db,$update);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=topics');
       
      
          
      }
}
?>