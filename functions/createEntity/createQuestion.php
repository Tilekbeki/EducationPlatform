<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';

    $title = trim(strip_tags($_POST['QuestionTitle'])) ?? null;
    $questionImg = mysqli_real_escape_string($db,file_get_contents($_FILES['QuestionImg']['tmp_name'])) ?? null;
    $answerImg = mysqli_real_escape_string($db,file_get_contents($_FILES['AnswerImg']['tmp_name'])) ?? null;
    $subtopic = mysqli_real_escape_string($db,$_POST['SelectedSubTopicName']) ?? null;

    $_SESSION['validation'] = [];

    if (empty($_FILES['QuestionImg']['tmp_name']) || empty($_FILES['AnswerImg']['tmp_name'])) {
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
    redirect('/admin/admin.php');
    }
    if ($title && $subtopic && $questionImg && $answerImg) {
          //достает по имени каждое поле и создает по нему одноименную переменую
          
        echo "asdasdas";
          $insertInQuestion = "INSERT INTO question (`imgQuestion`, `imgAnswer`, `subTopic`, `title`) VALUES('$questionImg', '$answerImg', '$subtopic', '$title')";
        //   $select = "SELECT `id` FROM `question` WHERE `title` = '$title'";
          
          
          $query = mysqli_query($db,$insertInQuestion);
            

        // $title = $_GET['title'];
        // $subtopic = $_GET['subtopic'];
        $select = "SELECT id FROM question ORDER BY id DESC LIMIT 1";
        
        $query1 = mysqli_query($db,$select);
        $question = mysqli_fetch_assoc($query1);
        $questionId = (int) $question['id'];

        $insertInSubtopicquestion = "INSERT INTO subtopicquestion (subtopic, id_question) VALUES('$subtopic', '$questionId')";
        $query2 = mysqli_query($db,$insertInSubtopicquestion);
        if ($query) header("Location: /admin/admin.php"); 
            
      } 



