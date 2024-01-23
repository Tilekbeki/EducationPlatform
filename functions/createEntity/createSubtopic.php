<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';

    $name = trim(strip_tags($_POST['SubTopicName'])) ?? null;
    $description = trim(strip_tags($_POST['SubTopicDescription'])) ?? null;
    $topic = trim(strip_tags($_POST['SelectedTopicName'])) ?? null;

    $_SESSION['validation'] = [];

    if ($name && $description && $topic) {

            $select = "SELECT `name` FROM `subtopic` WHERE name = '$name'";
            $query1 = mysqli_query($db,$select);
            $gotName = mysqli_fetch_assoc($query1);
            $reapetedCourseName = $gotName['name'] ?? null;
            if ($reapetedCourseName == $name) {
                addValidationError('SubTopicName', 'this subtopic already exist');
                if (!empty($_SESSION['validation'])) {
                    addOldValue('SubTopicName',$name);
                    addOldValue('SubTopicDescription',$description);
                }
                redirect('/admin/admin.php');
            
            } else {
                $insert = "INSERT INTO subtopic (`name`, `description`, `topic`) VALUES('$name', '$description', '$topic')";
      
                $query = mysqli_query($db,$insert);
            
                if ($query) header('Location: /index.php');
            }
          
      }
?>