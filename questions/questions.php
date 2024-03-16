<?php

// $subTopic = $GET['subtopic'];
require_once '../functions/db.php';
require_once '../templates/stylelink.php';

$subtopic = $_GET['subtopicname'];
$selectQuestions = "SELECT * FROM question WHERE subtopic = '$subtopic'";
    $queryQuestionsAll = mysqli_query($db, $selectQuestions);
    $questions = mysqli_fetch_all($queryQuestionsAll, MYSQLI_ASSOC);

$selectSections = "SELECT * FROM sectionofquestion";
$querySectionsAll = mysqli_query($db, $selectSections);
$sections = mysqli_fetch_all($querySectionsAll, MYSQLI_ASSOC);

$select2 = "SELECT `name`,  `description`, `metaKeywords` FROM subtopic WHERE name='$subtopic'";
$subtopics = mysqli_query($db, $select2);
$subtopics = mysqli_fetch_all($subtopics, MYSQLI_ASSOC); 


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $keywords=[]; foreach ($subtopics as $subtop) { 
            if ($subtop['metaKeywords']) {
                array_push($keywords, $subtop['metaKeywords']);
         } } $visibleKeys = implode(", ", $keywords);?>
    <meta name="keywords" content="<?php echo $visibleKeys; ?>">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <title>Questions <?php echo $subtopic; ?></title>
</head>
<body>
    <?php require_once '../templates/header.php'; ?>
<div>
<div class="container">
<h1 class="questions__title title_orange">Subtopic: <?php echo $subtopic; ?></h1>
<h2>Questions</h2>
</div>
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
                    <?php foreach ($sections as $section) { 
                        if ($section['answerImg']) {?>
                        <div class="questions__section">
                            <?php if($section['id_question']==$question['id'] && $section['answerImg'] ) {?>
                                <div class="questions__section-item">
                                    <div class="questions__section-title">
                                        <?php if($section['answerImg']) { ?>
                                    <!-- <img src="data:image/png;base64, <?php /*echo base64_encode($section['answerImg']);; */ ?>" alt="title" class="questions__question-img"> -->
                                    <?php } ?>
                                    </div>
                                    <?php
                                        if($section['answerImg']) { ?>
                                            <div class="questions__controllers">
                                        <div class="questions__controllers-check">View Answer</div>
                                        <div class="questions__modal">
                                        <div class="container">
                                                <div class="questions__modal-content">
                                                    <div class="questions__modal-wrapp">
                                                        <div class="questions__modal-question"><h3>Question:</h3> <img src="data:image/png;base64, <?php echo base64_encode($question['imgQuestion']);; ?>" alt="question" class="questions__question"></div>
                                                        <div class="questions__modal-answer"><h4><?php /*echo $section['name'];*/ echo "Answer" ?></h4><img src="data:image/png;base64, <?php echo base64_encode($section['answerImg']);; ?>" alt="question" class="questions__subquestion"></div>
                                                    </div>
                                                    <div class="questions__modal-close">&times;</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php }
                                    ?>
                                </div>
                            <?php }
                             ?>
                        </div>
                    <?php }} ?>
                    
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
 </div>
 <script src="../assets/js/questions.js"></script>