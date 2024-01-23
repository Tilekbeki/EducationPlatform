<?php 
    session_start(); 
    require_once '../functions/db.php';
    require_once '../functions/form/helper.php';

    $selectSubjects = "SELECT name FROM subject";
    $queryForSubjectsAll = mysqli_query($db, $selectSubjects);
    $subjects = mysqli_fetch_all($queryForSubjectsAll, MYSQLI_ASSOC);

    $selectCourses = "SELECT name FROM course";
    $queryForCoursesAll = mysqli_query($db, $selectCourses);
    $courses = mysqli_fetch_all($queryForCoursesAll, MYSQLI_ASSOC);
    

    $selectTopics = "SELECT name FROM topic";
    $queryForTopicsAll = mysqli_query($db, $selectTopics);
    $topics = mysqli_fetch_all($queryForTopicsAll, MYSQLI_ASSOC);

    $selectSubTopics = "SELECT name FROM subtopic";
    $queryForSubTopicsAll = mysqli_query($db, $selectSubTopics);
    $subtopics = mysqli_fetch_all($queryForSubTopicsAll, MYSQLI_ASSOC);



    $indexphp=0; 
    $styleInexLink = "/assets/css/style.css";
    $styleUsualLink = "../assets/css/style.css";

?>
<!DOCTYPE html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="<?php echo $indexphp ? $styleInexLink : $styleUsualLink; ?>">
</head>
<body>
<div class="admin">
    <div class="admin__header">
        <div class="container">
            <div class="admin__header-wrap">
                <ul class="admin__menu">
                    <li class="admin__menu-item"><a href="?do=subjects">Subjects</a></li>
                    <li class="admin__menu-item"><a href="?do=courses">Courses</a></li>
                    <li class="admin__menu-item"><a href="?do=topics">Topics</a></li>
                    <li class="admin__menu-item"><a href="?do=subjects">Subtopics</a></li>
                    <li class="admin__menu-item"><a href="?do=questions">Questions</a></li>
                </ul>
                <a href="/">logout</a>
            </div>
        </div>
    </div>
</div>

<div class="admin__content">
    <div class="container">
        <div class="admin__subject">
            <?php if (!empty($_GET['update_subject'])) { ?>

                            <h2>Редактировать тимейта</h2>
                <form action="engine/update.php" method="POST">
                    <?php  foreach($subjects as $member) {
                        if ($member['name'] == $_GET['update_subject']) { ?>
                            <p><input type="text" name="name" value="<?php echo $member['name'] ?>"><br></p>

                        <?php }
                    }

                    ?>
                    <p><input type="hidden" name="id" value="<?php echo $_GET['update_member'] ?>"></p>
                    
                    <button type="submit">Submit</button>
                </form>
            <?php } if($_GET['do'] == 'subjects') { echo $_GET['do']; ?>
            <div class="admin__subject-create">
                <h2 class="title_fz-34">Create Subject:</h2>
                    <form action="../functions/createEntity/createSubject.php" method="POST">
                            <label for="SubjectName">
                                <p>Subject name</p>
                                <input required type="text" <?php validationErrorAttr('SubjectName'); ?>  name="SubjectName" placeholder="Math" id="SubjectName" value="<?php echo old('SubjectName') ?>">
                                    <?php if(hasValidationError('SubjectName')): ?>
                                            <small><?php validationErrorMessage('SubjectName'); ?></small>
                                        <?php endif;?>
                            </label>
                        <button type="submit">Add</button>
                    </form>
            </div>
            <?php } ?>
            <h3 class="title_fz-28"><?php echo count($subjects) ?> subjects</h3>
            <hr class="admin__hr">
            <div class="admin__subject-list">
                <?php foreach ($subjects as $subject) { ?> 
                    <div class="admin__subject-item">
                        <div class="admin__subject-name"><?php echo $subject['name']; ?></div>
                        <a href="/admin/admin.php?update_subject=<?php echo $subject['name']; ?>" class="admin__subject-edit">Update</a>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>


<h2>Create Course:</h2>
<form action="../functions/createEntity/createCourse.php" method="POST">
    <label for="CourseName">
            <input required type="text" <?php validationErrorAttr('CourseName'); ?>  name="CourseName" placeholder="Course name" id="CourseName" value="<?php echo old('CourseName') ?>" >
                <?php if(hasValidationError('CourseName')): ?>
                        <small><?php validationErrorMessage('CourseName'); ?></small>
                    <?php endif;?>
    </label>
    <label for="CourseDescription">
        <input required type="text" <?php validationErrorAttr('CourseDescription'); ?>  name="CourseDescription" placeholder="Description" id="CourseDescription" value="<?php echo old('CourseDescription') ?>">
            <?php if(hasValidationError('CourseDescription')): ?>
                    <small><?php validationErrorMessage('CourseDescription'); ?></small>
                <?php endif;?>
    </label>
    <label for="CourseSuccessTips">
        <input required type="text" <?php validationErrorAttr('CourseSuccessTips'); ?>  name="CourseSuccessTips" placeholder="Success tips" id="CourseSuccessTips" value="<?php echo old('CourseSuccessTips') ?>">
            <?php if(hasValidationError('CourseSuccessTips')): ?>
                    <small><?php validationErrorMessage('CourseSuccessTips'); ?></small>
                <?php endif;?>
    </label>
    <label for="SelectedSubjectName">
    <select required type="text" <?php validationErrorAttr('SelectedSubjectName'); ?>  name="SelectedSubjectName" placeholder="Subject name" id="SubjectName">
                <?php foreach ($subjects as $subject) { ?>
                <option value="<?php echo $subject['name']  ?>"><?php echo $subject['name'] ?></option>
                <?php }?>
    </select>
    </label>
    <button type="submit">Add</button>
</form>


<h2>Create Topic:</h2>
<form action="../functions/createEntity/createTopic.php" method="POST">
    <label for="TopicName">
        <input required type="text" <?php validationErrorAttr('TopicName'); ?>  name="TopicName" placeholder="Topic name" id="TopicName" value="<?php echo old('TopicName') ?>">
            <?php if(hasValidationError('TopicName')): ?>
                    <small><?php validationErrorMessage('TopicName'); ?></small>
                <?php endif;?>
    </label>
    <label for="TopicPrice">
        <input required type="number" <?php validationErrorAttr('TopicPrice'); ?>  name="TopicPrice" placeholder="Topic price" id="TopicPrice" value="<?php echo old('TopicPrice') ?>">
            <?php if(hasValidationError('TopicPrice')): ?>
                    <small><?php validationErrorMessage('TopicPrice'); ?></small>
                <?php endif;?>
    </label>
    <label for="SelectedCourseName">
    <select required type="text" <?php validationErrorAttr('SelectedCourseName'); ?>  name="SelectedCourseName" placeholder="Subject course" id="SelectedCourseName">
                <?php foreach ($courses as $course) { ?>
                <option value="<?php echo $course['name']  ?>"><?php echo $course['name'] ?></option>
                <?php }?>
    </select>
    </label>
    <button type="submit">Add</button>
</form>

<h2>Create Subtopic:</h2>
<form action="../functions/createEntity/createSubtopic.php" method="POST">
<label for="SubTopicName">
        <input required type="text" <?php validationErrorAttr('SubTopicName'); ?>  name="SubTopicName" placeholder="SubTopic name" id="SubTopicName" value="<?php echo old('SubTopicName') ?>">
            <?php if(hasValidationError('SubTopicName')): ?>
                    <small><?php validationErrorMessage('SubTopicName'); ?></small>
                <?php endif;?>
    </label>
    <label for="SubTopicDescription">
        <input required type="text" <?php validationErrorAttr('SubTopicDescription'); ?>  name="SubTopicDescription" placeholder="SubTopic description" id="SubTopicDescription" value="<?php echo old('SubTopicDescription') ?>">
            <?php if(hasValidationError('SubTopicDescription')): ?>
                    <small><?php validationErrorMessage('SubTopicDescription'); ?></small>
                <?php endif;?>
    </label>
    <label for="SelectedTopicName">
    <select required type="text" <?php validationErrorAttr('SelectedTopicName'); ?>  name="SelectedTopicName" placeholder="Subject topic" id="SelectedTopicName">
                <?php foreach ($topics as $topic) { ?>
                <option value="<?php echo $topic['name']  ?>"><?php echo $topic['name'] ?></option>
                <?php }?>
    </select>
    </label>
    <button type="submit">Add</button>
</form>

<h2>Create Question:</h2>
<form action="../functions/createEntity/createQuestion.php" method="POST" enctype="multipart/form-data">
<p><input required type="text" name="QuestionTitle" placeholder="title" value="<?php echo old('QuestionTitle') ?>"><br></p>
    <label for="QuestionImg">
        <input required type="file" <?php validationErrorAttr('QuestionImg'); ?>  name="QuestionImg" id="QuestionImg">
            <?php if(hasValidationError('QuestionImg')): ?>
                    <small><?php validationErrorMessage('QuestionImg'); ?></small>
                <?php endif;?>
    </label>
    <label for="AnswerImg">
        <input required type="file" <?php validationErrorAttr('AnswerImg'); ?>  name="AnswerImg" id="AnswerImg" value="<?php echo old('AnswerImg') ?>">
            <?php if(hasValidationError('AnswerImg')): ?>
                    <small><?php validationErrorMessage('AnswerImg'); ?></small>
                <?php endif;?>
    </label>
    <label for="SelectedSubTopicName">
    <select required type="text" <?php validationErrorAttr('SelectedSubTopicName'); ?>  name="SelectedSubTopicName" id="SelectedSubTopicName">
                <?php foreach ($subtopics as $subtopic) { ?>
                <option value="<?php echo $subtopic['name']  ?>"><?php echo $subtopic['name'] ?></option>
                <?php }?>
    </select>
    </label>
    <button type="submit">Add</button>
</form>


<?php
    // require_once '../functions/db.php';
    // if (!empty($_GET)) {
    //     $title = $_GET['title'];
    //     $subtopic = $_GET['subtopic'];
    //     $select = "SELECT id FROM question ORDER BY id DESC LIMIT 1";
        
    //     $query = mysqli_query($db,$select);
    //     $question = mysqli_fetch_assoc($query);
    //     $questionId = (int) $question['id'];

    //     $insertInSubtopicquestion = "INSERT INTO subtopicquestion (subtopic, id_question) VALUES('$subtopic', '$questionId')";
    //     $query2 = mysqli_query($db,$insertInSubtopicquestion);
    //     if ($query2) header("Location: /EducationPlatform/admin/admin.php?questions=hehe"); 

    // }
?>

<?php clearValidation(); ?>