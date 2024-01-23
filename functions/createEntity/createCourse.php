<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';


    $name = trim(strip_tags($_POST['CourseName'])) ?? null;
    $description = trim(strip_tags($_POST['CourseDescription'])) ?? null;
    $successTips = trim(strip_tags($_POST['CourseSuccessTips'])) ?? null;
    $subject = strip_tags($_POST['SelectedSubjectName']) ?? null;

    $_SESSION['validation'] = [];

    

    if ($name && $description && $successTips && $subject) {
        $select = "SELECT `name` FROM `course` WHERE name = '$name'";
        $query1 = mysqli_query($db,$select);
        $gotName = mysqli_fetch_assoc($query1);
        $reapetedCourseName = $gotName['name'] ?? null;
        
        if ($reapetedCourseName == $name) {
            addValidationError('CourseName', 'this course already exist');
            if (!empty($_SESSION['validation'])) {
                addOldValue('CourseName',$name);
                addOldValue('CourseDescription',$description);
                addOldValue('CourseSuccessTips',$successTips);
            }
            redirect('/admin/admin.php');
        } else {
            $insert = "INSERT INTO course (`name`, `description`, `successTips`, `subject`) VALUES('$name', '$description', '$successTips', '$subject')";
      
            $query = mysqli_query($db,$insert);
            
            if ($query) header('Location: /index.php');
        }
          
      }
?>