<?php
require_once '../db.php';

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST['CourseName'])) ?? null;
    $oldName = trim(strip_tags($_POST['OldCourseName'])) ?? null;
    $descr =trim(strip_tags($_POST['CourseDescription'])) ?? null;
    $oldDescr = trim(strip_tags($_POST['OldCourseDescription'])) ?? null;
    $successTips = trim(strip_tags($_POST['CourseSuccesTips'])) ?? null;
    $oldSuccessTips = trim(strip_tags($_POST['OldCourseSuccesTips'])) ?? null;
    if ($name) {
        
        $update = "UPDATE `course` SET `name`='$name',`description`='$descr',`successTips`='$successTips' WHERE name = '$oldName'";

        $query = mysqli_query($db,$update);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=courses');
       
      
          
      }
}
?>