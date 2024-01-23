<?php

// $subTopic = $GET['subtopic'];
require_once '../functions/db.php';
require_once '../templates/stylelink.php';

$subtopic = $_GET['subtopicname'];
$selectQuestions = "SELECT * FROM question WHERE subtopic = '$subtopic'";
    $queryQuestionsAll = mysqli_query($db, $selectQuestions);
    $questions = mysqli_fetch_all($queryQuestionsAll, MYSQLI_ASSOC);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <title>Education Platform</title>
</head>
<body>
    <?php require_once '../templates/header.php'; ?>
<div class="container">
<h1 class="questions__title">Subtopic: <?php echo $subtopic; ?></h1>
<h2>Questions</h2>
</div>

 <div class="questions">
    <div class="container">
    
        <div class="questions__list">
        <?php $i=1; foreach ($questions as $question) { ?>
            <div class="questions__item-num">Question <?php echo $i; ?></div>
            <div class="questions__item">
                
                <div class="questions__item-wrap">
                    <div class="questions__item-question">
                        <!-- <div class="questions__item-title"><?php echo $question['title']; $img = base64_encode($question['imgQuestion']);?></div> -->
                        <img src="data:image/png;base64, <?php echo $img; $i++;?>" alt="question" class="questions__item-img">
                    </div>
                    <div class="questions__controllers">
                        <div class="questions__controllers-check">Mark Scheme</div>
                        <div class="questions__modal">
                        <div class="container">
                                <div class="questions__modal-content">
                                    <div class="questions__modal-wrapp">
                                        <div class="questions__modal-question"><h3>Question</h3><img src="data:image/png;base64, <?php echo $img; ?>" alt="question" class="questions__item-img"></div>
                                        <div class="questions__modal-answer"><h3>Answer</h3><img src="data:image/png;base64, <?php echo base64_encode($question['imgAnswer']);; ?>" alt="question" class="questions__item-img"></div>
                                    </div>
                                    <div class="questions__modal-close">&times;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
 </div>
 <script src="../assets/js/questions.js"></script>