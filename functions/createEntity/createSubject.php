<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';


    $name = trim(strip_tags($_POST['SubjectName'])) ?? null;
    $_SESSION['validation'] = [];

    if(empty($name)) {
        addValidationError('SubjectName', 'Wrong name');
        redirect('/EducationPlatform/admin/admin.php?do=subjects');
    } 
    if ($name) {
        $select = "SELECT `name` FROM `subject` WHERE name = '$name'";
        $query1 = mysqli_query($db,$select);
        $gotName = mysqli_fetch_assoc($query1);
        $reapetedSubjectName = $gotName['name'];
        if ($reapetedSubjectName == $name) {
            addValidationError('SubjectName', 'this subject already exist');
            if (!empty($_SESSION['validation'])) {
                addOldValue('SubjectName',$name);
            }
            redirect('/EducationPlatform/admin/admin.php?do=subjects');
        } else {
            $insert = "INSERT INTO subject (`name`) VALUES('$name')";
      
          $query = mysqli_query($db,$insert);
      
          if ($query) redirect('/EducationPlatform/admin/admin.php?do=subjects');
        }
      
          
      }
?>