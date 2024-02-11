<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';

    $title = trim(strip_tags($_POST['QuestionTitle'])) ?? null;
    $questionImg = mysqli_real_escape_string($db,file_get_contents($_FILES['QuestionImg']['tmp_name'])) ?? null;
    $subtopic = mysqli_real_escape_string($db,$_POST['SelectedSubTopicName']) ?? null;
    $metaKeywords = trim(strip_tags($_POST['QuestionMetaKeywords'])) ?? null;
    $metaDescription = trim(strip_tags($_POST['QuestionMetaDescription'])) ?? null;

    $_SESSION['validation'] = [];

    if (empty($_FILES['QuestionImg']['tmp_name'])) {
      if(empty($_FILES['QuestionImg']['tmp_name'])) {
        addValidationError('QuestionImg', 'there is no file');
      }
      if(empty($_FILES['AnswerImg']['tmp_name'])) {
        addValidationError('AnswerImg', 'there is no file');
      }
      if (!empty($_SESSION['validation'])) {
        addOldValue('QuestionImg',$questionImg);
        addOldValue('CourseDescription',$answerImg);
        addOldValue('QuestionTitle',$title);
    }
    redirect('/EducationPlatform/admin/admin.php');
    }
    if ($title && $subtopic && $questionImg) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          
          $insertInQuestion = "INSERT INTO question (`imgQuestion`, `subTopic`, `title`, `metaKeywords`, `metaDescription`) VALUES('$questionImg', '$subtopic', '$title','$metaKeywords','$metaDescription')";
        //   $select = "SELECT `id` FROM `question` WHERE `title` = '$title'";
          
          
          $query = mysqli_query($db,$insertInQuestion);
            

        // $title = $_GET['title'];
        // $subtopic = $_GET['subtopic'];
        //создание субтопика промежуточной таблицы
        $select = "SELECT id FROM question ORDER BY id DESC LIMIT 1";
        
        $query1 = mysqli_query($db,$select);
        $question = mysqli_fetch_assoc($query1);
        $questionId = (int) $question['id'];

        $insertInSubtopicquestion = "INSERT INTO subtopicquestion (subtopic, id_question) VALUES('$subtopic', '$questionId')";
        $query2 = mysqli_query($db,$insertInSubtopicquestion);
        //создание таблицы секций
        $inserA = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('a',NULL,NULL,'$questionId')";
        $inserB = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('b',NULL,NULL,'$questionId')";
        $inserC = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('c',NULL,NULL,'$questionId')";
        $inserD = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('d',NULL,NULL,'$questionId')";
        $inserE = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('e',NULL,NULL,'$questionId')";
        $inserF = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('f',NULL,NULL,'$questionId')";
        $inserG = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('g',NULL,NULL,'$questionId')";
        $inserH = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('h',NULL,NULL,'$questionId')";
        $inserI = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('i',NULL,NULL,'$questionId')";
        $inserJ = "INSERT INTO `sectionofquestion`(`name`, `title`, `answerImg`, `id_question`) VALUES ('j',NULL,NULL,'$questionId')";
        
        $query3 = mysqli_query($db,$inserA);
        $query4 = mysqli_query($db,$inserB);
        $query5 = mysqli_query($db,$inserC);
        $query6 = mysqli_query($db,$inserD);
        $query7 = mysqli_query($db,$inserE);
        $query8 = mysqli_query($db,$inserF);
        $query9 = mysqli_query($db,$inserG);
        $query10 = mysqli_query($db,$inserH);
        $query11 = mysqli_query($db,$inserI);
        $query12 = mysqli_query($db,$inserJ);
        if ($query) header("Location: /EducationPlatform/admin/admin.php"); 
            
      } 



