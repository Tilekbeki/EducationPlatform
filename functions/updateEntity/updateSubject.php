<?php
require_once '../db.php';

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST['SubjectName'])) ?? null;
    $oldName = trim(strip_tags($_POST['OldSubjectName'])) ?? null;
    if ($name) {
        
        $update = "UPDATE subject SET name = '$name' WHERE name = '$oldName'";

        $query = mysqli_query($db,$update);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=subjects');
       
      
          
      }
}
?>