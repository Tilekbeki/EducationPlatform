<?php
require_once '../db.php';

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST['SubTopicName'])) ?? null;
    $oldName = trim(strip_tags($_POST['OldSubTopicName'])) ?? null;
    $descr =trim(strip_tags($_POST['SubTopicDescr'])) ?? null;
    $oldDescr = trim(strip_tags($_POST['OldSubTopicDescr'])) ?? null;
    $metaKeywords = trim(strip_tags($_POST['SubTopicMetakeywords'])) ?? null;
    $metaDescription = trim(strip_tags($_POST['SubTopicMetaDescr'])) ?? null;
    if ($name && $descr) {
        
        $update = "UPDATE `subtopic` SET `name`='$name',`description`='$descr', `metaKeywords`='$metaKeywords', `metaDescription`= '$metaDescription' WHERE name = '$oldName'";

        $query = mysqli_query($db,$update);

        $update2 = "UPDATE question SET subTopic='$name' WHERE subTopic='$oldName'";
        $query2 = mysqli_query($db,$update2);
        if ($query2 && $query) header('Location: /EducationPlatform/admin/admin.php?do=subtopics');
       
      
          
      }
}
?>