<?php
     session_start();
     require_once '../db.php';
     require_once '../form/helper.php';

    $name = trim(strip_tags($_POST['TopicName'])) ?? null;
    $price = trim(strip_tags($_POST['TopicPrice'])) ?? null;
    $price = (int) $price;
    $course = trim(strip_tags($_POST['SelectedCourseName'])) ?? null;
    $metaKeywords = trim(strip_tags($_POST['TopicMetaKeywords'])) ?? null;
    $metaDescription = trim(strip_tags($_POST['TopicMetaDescription'])) ?? null;

    $_SESSION['validation'] = [];

    if ($name && $price>=0 && $course && $metaKeywords && $metaDescription) {
            $select = "SELECT `name` FROM `topic` WHERE name = '$name'";
            $query1 = mysqli_query($db,$select);
            $gotName = mysqli_fetch_assoc($query1);
            $reapetedTopicName = $gotName['name'] ?? null;
            
            if ($reapetedTopicName == $name) {
                addValidationError('TopicName', 'this topic already exist');
                if (!empty($_SESSION['validation'])) {
                    addOldValue('TopicName',$name);
                    addOldValue('TopicPrice',$price);
                    
                }
                redirect('/EducationPlatform/admin/admin.php?do=topics');
            } else {
                $insert = "INSERT INTO topic (`name`, `price`, `course`, `metaKeywords`, `metaDescription`) VALUES('$name', '$price', '$course', '$metaKeywords', '$metaDescription')";
      
                $query = mysqli_query($db,$insert);
            
                if ($query) redirect('/EducationPlatform/admin/admin.php?do=topics');
            }
      
          
      } else {
        addValidationError('TopicPrice', 'invalid number');
        if (!empty($_SESSION['validation'])) {
            addOldValue('TopicName',$name);
            addOldValue('TopicPrice',$price);
            
        }
        redirect('/EducationPlatform/admin/admin.php?do=topics&course='.$course.'&subject=besh');
      }
?>