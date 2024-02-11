<?php 
    session_start(); 
    require_once '../functions/db.php';
    require_once '../functions/form/helper.php';

    $selectSubjects = "SELECT * FROM subject";
    $queryForSubjectsAll = mysqli_query($db, $selectSubjects);
    $subjects = mysqli_fetch_all($queryForSubjectsAll, MYSQLI_ASSOC);

    $selectCourses = "SELECT * FROM course";
    $queryForCoursesAll = mysqli_query($db, $selectCourses);
    $courses = mysqli_fetch_all($queryForCoursesAll, MYSQLI_ASSOC);
    

    $selectTopics = "SELECT * FROM topic";
    $queryForTopicsAll = mysqli_query($db, $selectTopics);
    $topics = mysqli_fetch_all($queryForTopicsAll, MYSQLI_ASSOC);

    $selectSubTopics = "SELECT * FROM subtopic";
    $queryForSubTopicsAll = mysqli_query($db, $selectSubTopics);
    $subtopics = mysqli_fetch_all($queryForSubTopicsAll, MYSQLI_ASSOC);
    
    
    $selectQuestions = "SELECT * FROM question";
    $queryForQuestionsAll = mysqli_query($db, $selectQuestions);
    $questions = mysqli_fetch_all($queryForQuestionsAll, MYSQLI_ASSOC);

    $selectSelections = "SELECT * FROM sectionofquestion";
    $queryForSelectionsAll = mysqli_query($db, $selectSelections);
    $selections = mysqli_fetch_all($queryForSelectionsAll, MYSQLI_ASSOC);

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
                    <li class="admin__menu-item"><a href="?do=subtopics">Subtopics</a></li>
                    <li class="admin__menu-item"><a href="?do=questions">Questions</a></li>
                    <li class="admin__menu-item"><a href="?do=sections">Sections</a></li>
                </ul>
                <a href="/EducationPlatform">logout</a>
            </div>
        </div>
    </div>
</div>

<div class="admin__content">
    <div class="container">
        <div class="admin__wrap">
            <?php if (empty($_GET['update_subject']) && empty($_GET['do']) && empty($_GET['update_course']) && empty($_GET['update_topic']) && empty($_GET['update_subtopic']) && empty($_GET['update_question']) && empty($_GET['update_section'])) { ?>
                <h1>Welcome to admin panel</h1>
            <?php } ?>
            <?php if (!empty($_GET['update_subject'])) { ?>
                <h2>Edit subject <?php echo $_GET['update_subject'] ?></h2>
                <form action="../functions/updateEntity/updateSubject.php" method="POST">
                    <?php  foreach($subjects as $subject) {
                        if ($subject['name'] == $_GET['update_subject']) { ?>
                            <p><input type="text" required name="SubjectName" value="<?php echo $subject['name']?>" placeholder="Subject name"><br></p>
                            <p><input type="hidden" name="OldSubjectName" value="<?php echo $subject['name']?>"></p>
                        <?php }
                    }

                    ?>
                    
                    <button type="submit">Edit</button>
                </form>
            <?php } if(isset($_GET['do']) && $_GET['do']  == 'subjects') {  ?>
            <div class="admin__create">
                <h2 class="title_fz-34 admin__title-create">Create Subject:</h2>
                    <form action="../functions/createEntity/createSubject.php" method="POST">
                            <label for="SubjectName">
                                <!-- <p>Subject name</p> -->
                                <p>Subject name</p>
                                <input required type="text" <?php validationErrorAttr('SubjectName'); ?>  name="SubjectName" placeholder="Subject name" id="SubjectName" value="<?php echo old('SubjectName') ?>">
                                    <?php if(hasValidationError('SubjectName')): ?>
                                            <small><?php validationErrorMessage('SubjectName'); ?></small>
                                        <?php endif;?>
                            </label>
                        <button type="submit">Add</button>
                    </form>
                    
            </div>
            <!-- .. -->
            <hr class="admin__hr">
            <div class="admin__list">
            <table>
                <tr><th>Subject</th><th>Delete</th><th>Update</th></tr> 
                 <!--ряд с ячейками тела таблицы-->
                                        
                <?php foreach ($subjects as $subject) { ?> 
                    <tr>
                        <td><?php echo $subject['name']; ?></td>
                        <td><a href="/EducationPlatform/functions/deleteEntity/deleteSubject.php?subject=<?php echo $subject['name']; ?>" class="admin__btn-delete" class="admin__btn-delete">Delete</a></td>
                        <td><a href="/EducationPlatform/admin/admin.php?update_subject=<?php echo $subject['name']; ?>" class="admin__btn-edit">Update</a></td>
                    </tr>
                    <!-- <div class="admin__list-item">
                        <div class="admin__list-name">• <?php echo $subject['name']; ?></div>
                        <div class="admin__list-btns">
                        <a href="/EducationPlatform/functions/deleteEntity/deleteSubject.php?subject=<?php echo $subject['name']; ?>" class="admin__btn-delete" class="admin__btn-delete">Delete</a>
                        <a href="/EducationPlatform/admin/admin.php?update_subject=<?php echo $subject['name']; ?>" class="admin__btn-edit">Update</a>
                        </div>
                    </div> -->
                <?php } ?>
            <?php } ?>
            </table>
            <?php if(isset($_GET['do']) && $_GET['do']  == 'courses') { ?>
                    <div class="admin__create">
                        <h2 class="title_fz-34 admin__title-create">Create Course:</h2>
                        <form action="../functions/createEntity/createCourse.php" method="POST">
                            <label for="CourseName">
                                <p>Course name</p>
                                    <input required type="text" <?php validationErrorAttr('CourseName'); ?>  name="CourseName" placeholder="Course name" id="CourseName" value="<?php echo old('CourseName') ?>" >
                                        <?php if(hasValidationError('CourseName')): ?>
                                                <small><?php validationErrorMessage('CourseName'); ?></small>
                                            <?php endif;?>
                            </label>
                            <label for="CourseDescription">
                                <p>Description</p>
                                <input required type="text" <?php validationErrorAttr('CourseDescription'); ?>  name="CourseDescription" placeholder="Description" id="CourseDescription" value="<?php echo old('CourseDescription') ?>">
                                    <?php if(hasValidationError('CourseDescription')): ?>
                                            <small><?php validationErrorMessage('CourseDescription'); ?></small>
                                        <?php endif;?>
                            </label>
                            <label for="CourseSuccessTips">
                                <p>Success Tips</p>
                                <input required type="text" <?php validationErrorAttr('CourseSuccessTips'); ?>  name="CourseSuccessTips" placeholder="Success tips" id="CourseSuccessTips" value="<?php echo old('CourseSuccessTips') ?>">
                                    <?php if(hasValidationError('CourseSuccessTips')): ?>
                                            <small><?php validationErrorMessage('CourseSuccessTips'); ?></small>
                                        <?php endif;?>
                            </label>
                            <label for="SelectedSubjectName">
                                <p>Subject</p>
                            <select required type="text" <?php validationErrorAttr('SelectedSubjectName'); ?>  name="SelectedSubjectName" placeholder="Subject name" id="SubjectName">
                                        <?php foreach ($subjects as $subject) { ?>
                                        <option value="<?php echo $subject['name']  ?>"><?php echo $subject['name'] ?></option>
                                        <?php }?>
                            </select>
                            </label>
                            <button type="submit">Add</button>
                        </form>
                        <div class="admin__list">
                        <table>
                        <tr><th>Course</th><th>Subject</th><th>Delete</th><th>Update</th></tr> 
                            <?php foreach ($courses as $course) { ?> 
                                
                                <tr>
                                    <td><?php echo $course['name']; ?></td>
                                    <td><?php echo $course['subject']; ?></td>
                                    <td><a href="/EducationPlatform/functions/deleteEntity/deleteCourse.php?course=<?php echo $course['name']; ?>" class="admin__btn-delete" class="admin__btn-delete" class="admin__btn-delete">Delete</a></td>
                                    <td><a href="/EducationPlatform/admin/admin.php?update_course=<?php echo $course['name']; ?>" class="admin__btn-edit">Update</a></td>
                                </tr>

                                
                            <?php } ?>
                            </table>
                        </div>
                        <?php } ?>
                        <?php if (!empty($_GET['update_course'])) { ?>
                                <h2>Edit course <?php echo $_GET['update_course'] ?></h2>
                                <form action="../functions/updateEntity/updateCourse.php" method="POST">
                                <?php foreach ($courses as $course) {
                                 if ($course['name'] == $_GET['update_course']) { ?>
                                    <p>Course name</p>
                                    <p><input type="text" required name="CourseName" value="<?php echo $course['name']?>" placeholder="Course name"><br></p>
                                    <p><input type="hidden" name="OldCourseName" value="<?php echo $course['name']?>"></p>
                                    <p>Description</p>
                                    <p><input type="text" required name="CourseDescription" value="<?php echo $course['description']?>" placeholder="Course description"><br></p>
                                    <p><input type="hidden" name="OldCourseDescription" value="<?php echo $course['description']?>"></p>
                                    <p>Success Tips</p>
                                    <p><input type="text" required name="CourseSuccesTips" value="<?php echo $course['successTips']?>" placeholder="Course success tips"><br></p>
                                    <p><input type="hidden" name="OldCourseSuccesTips" value="<?php echo $course['successTips']?>"></p>
                                <?php } } ?>
                                <button type="submit">Edit</button>
                                 </form>
                                    <?php }?>
                        <?php if(isset($_GET['do']) && $_GET['do']  == 'topics') { ?>
                            <div class="admin__create">
                            <?php 
                                if(Isset($_GET['do']) && $_GET['do'] == 'topics' && !Isset($_GET['subject']) && !Isset($_GET['course'])) {
                                    echo "<h1>Select course by subject to create</h1>";
                                    $i=1; 
                                    
                                    foreach ($subjects as $subject) { ?>
                                    <h6 class="select__title-subject"><?php echo $i.") Subject: " .$subject['name']; $i++;?></h6>
                                    <div class="select__title-course"><?php echo "Courses:" ?></div>
                                        <ul class="select__list-course">
                                        <?php 
                                        $courseTitle = '';
                                        foreach ($courses as $course) {?> 
                                            
                                            
                                            <?php if($subject['name'] == $course['subject']) 
                                             { $courseTitle='yes';?>
                                            
                                                <li><a href="?do=topics&course=<?php echo $course['name'] ?>&subject=<?php echo $course['subject'] ?>"><?php echo $course['name'] ?></a></li>
                                             
                                            </ul><?php
                                        }  ?>
                                            
                                        <?php
                                            }  if(!$courseTitle) { ?>
                                                <a href="?do=courses">there`s nothinggg, but you can create</a>;
                                            <?php }?>
                                            </ul><div classs="select__list-topic"></div><?php
                                        }
                                                                 } ?>
                                
                            <?php
                                if(Isset($_GET['do']) && $_GET['do'] == 'topics' && Isset($_GET['subject']) && Isset($_GET['course'])) { ?>
                                    <h2  class="title_fz-34 admin__title-create">Create Topic:</h2>
                                <form action="../functions/createEntity/createTopic.php" method="POST">
                                    <label for="TopicName">
                                        <p>Topic name</p>
                                        <input required type="text" <?php validationErrorAttr('TopicName'); ?>  name="TopicName" placeholder="Topic name" id="TopicName" value="<?php echo old('TopicName') ?>">
                                            <?php if(hasValidationError('TopicName')): ?>
                                                    <small><?php validationErrorMessage('TopicName'); ?></small>
                                                <?php endif;?>
                                    </label>
                                    <label for="TopicPrice">
                                    <p>Price</p>
                                        <input required type="number" <?php validationErrorAttr('TopicPrice'); ?>  name="TopicPrice" placeholder="Topic price" id="TopicPrice" value="<?php echo old('TopicPrice') ?>">
                                            <?php if(hasValidationError('TopicPrice')): ?>
                                                    <small><?php validationErrorMessage('TopicPrice'); ?></small>
                                                <?php endif;?>
                                    </label>
                                    <label for="TopicMetaDescription">
                                    <p>Meta description</p>
                                        <input required type="text" <?php validationErrorAttr('TopicMetaDescription'); ?>  name="TopicMetaDescription" placeholder="This is about..." id="TopicMetaDescription" value="<?php echo old('TopicMetaDescription') ?>">
                                            <?php if(hasValidationError('TopicMetaDescription')): ?>
                                                    <small><?php validationErrorMessage('TopicMetaDescription'); ?></small>
                                                <?php endif;?>
                                    </label>
                                    <label for="TopicMetaKeywords">
                                    <p>Meta keywords</p>
                                        <input required type="text" <?php validationErrorAttr('TopicMetaKeywords'); ?>  name="TopicMetaKeywords" placeholder="keyword 1, keyword 2, ..." id="TopicMetaKeywords" value="<?php echo old('TopicMetaKeywords') ?>">
                                            <?php if(hasValidationError('TopicMetaKeywords')): ?>
                                                    <small><?php validationErrorMessage('TopicMetaKeywords'); ?></small>
                                                <?php endif;?>
                                    </label>
                                    <label for="SelectedCourseName">
                                    <p>Course</p>
                                    <select required type="text" <?php validationErrorAttr('SelectedCourseName'); ?>  name="SelectedCourseName" placeholder="Subject course" id="SelectedCourseName">
                                                <?php foreach ($courses as $course) { 
                                                    if($course['name'] == $_GET['course'] && $_GET['subject'] == $course['subject']) {?>
                                                <option value="<?php echo $course['name']  ?>"><?php echo $course['name'] ?></option>
                                                <?php }}?>
                                    </select>
                                    </label>
                                    <button type="submit">Add</button>
                                </form>
                                <?php } 
                            ?>
                                <div class="admin__list">
                                <table>
                                <tr><th>Topic</th><th>Course</th><th>Subject</th><th>Delete</th><th>Update</th></tr> 
                                        <?php foreach ($topics as $topic) { ?> 
                                            <tr>
                                            <td><?php echo $topic['name'] ?></td>
                                            <td><?php echo $topic['course'] ?></td>
                                            <td><?php foreach ($courses as $course) {
                                                if($course['name'] == $topic['course']) {
                                                    echo $course['subject'];
                                                }
                                                } ?></td>
                                                <td><a href="/EducationPlatform/functions/deleteEntity/deleteTopic.php?topic=<?php echo $topic['name']; ?>" class="admin__btn-delete" class="admin__btn-delete" class="admin__btn-delete">Delete</a></td>
                                                <td><a href="/EducationPlatform/admin/admin.php?update_topic=<?php echo $topic['name']; ?>" class="admin__btn-edit">Update</a></td>
                                            </tr>
                                        <?php } ?>
                                        
                                    </div>
                                    </table>
                            </div>
                            <?php } ?>
                            <?php if (!empty($_GET['update_topic'])) { ?>
                                <h2>Edit course <?php echo $_GET['update_topic'] ?></h2>
                                <form action="../functions/updateEntity/updateTopic.php" method="POST">
                                <?php foreach ($topics as $topic) {
                                 if ($topic['name'] == $_GET['update_topic']) { ?>
                                    <p>Topic name</p>
                                    <p><input type="text" required name="TopicName" value="<?php echo $topic['name']?>" placeholder="Topic name"><br></p>
                                    <p><input type="hidden" name="OldTopicName" value="<?php echo $topic['name']?>"></p>
                                    <p>Price</p>
                                    <p><input type="text" required name="TopicPrice" value="<?php echo $topic['price']?>" placeholder="Topic price"><br></p>
                                    <p>Meta keywords</p>
                                    <p><input type="text" required name="TopicMetaKeywords" value="<?php echo $topic['metaKeywords']?>" placeholder="keyword 1, keyword 2, ..."><br></p>
                                    <p>Meta description</p>
                                    <p><input type="text" required name="TopicMetaDescription" value="<?php echo $topic['metaDescription']?>" placeholder="This is about ..."><br></p>
                                <?php } } ?>
                                <button type="submit">Edit</button>
                                 </form>
                                    <?php }?>
                            <?php if (!empty($_GET['update_subtopic'])) { ?>
                                <h2>Edit subtopic <?php echo $_GET['update_subtopic'] ?></h2>
                                <form action="../functions/updateEntity/updateSubTopic.php" method="POST">
                                <?php foreach ($subtopics as $subtopic) {
                                 if ($subtopic['name'] == $_GET['update_subtopic']) { ?>
                                    <p>Subtopic name</p>
                                    <p><input type="text" required name="SubTopicName" value="<?php echo $subtopic['name']?>" placeholder="Subtopic name"><br></p>
                                    <p><input type="hidden" name="OldSubTopicName" value="<?php echo $subtopic['name']?>"></p>
                                    <p>Description</p>
                                    <p><input type="text" required name="SubTopicDescr" value="<?php echo $subtopic['description']?>" placeholder="Subtopic description"><br></p>
                                    <p>Meta description</p>
                                    <p><input type="text" required name="SubTopicMetaDescr" value="<?php echo $subtopic['metaDescription']?>" placeholder="This is about..."><br></p>
                                    <p>Meta keywords</p>
                                    <p><input type="text" required name="SubTopicMetakeywords" value="<?php echo $subtopic['metaKeywords']?>" placeholder="keyword 1, keyword 2, ..."><br></p>
                                <?php } } ?>
                                <button type="submit">Edit</button>
                                 </form>
                            <?php }?>
                            <?php if(isset($_GET['do']) && $_GET['do']  == 'subtopics' && !Isset($_GET['topic'])) {
                                echo "<h1>Select topic by course to create</h1>";
                                $i=1; 
                                
                                foreach ($subjects as $subject) { ?>
                                <h6 class="select__title-subject"><?php echo $i.") Subject: " .$subject['name']; $i++;?></h6>
                                <div class="select__title-course"><?php echo "Courses:" ?></div>
                                    <ul class="select__list-course">
                                    <?php 
                                    $courseTitle = '';
                                    foreach ($courses as $course) {?> 
                                        
                                        
                                        <?php if($subject['name'] == $course['subject']) 
                                         { $courseTitle='yes';?>
                                        
                                            <li><a href="?do=topics&course=<?php echo $course['name'] ?>&subject=<?php echo $subject['name'] ?>"><?php echo $course['name'] ?></a></li>
                                         
                                            <div class="select__title-topic"><?php echo "Topics:" ?></div>
                                            
                                            <ul class="select__list-topic">
                                           
                                        <?php $topicTitle=''; foreach ($topics as $topic) {
                                            
                                            if($course['name'] == $topic['course']){ 
                                                $topicTitle='yes';?>
                                                <li><a href="?do=subtopics&topic=<?php echo $topic['name'] ?>"><?php echo $topic['name'] ?></a></li>
                                           <?php }
                                            
                                        } if (!$topicTitle) { ?>
                                            <a href="?do=topics&course=<?php echo $course['name']; ?>&subject=<?php echo $subject['name']; ?>">there`s nothinggg, but you can create</a>;
                                        <?php }?>
                                        </ul><?php
                                    }  ?>
                                        
                                    <?php
                                        }  if(!$courseTitle) { ?>
                                            <a href="?do=courses">there`s nothinggg, but you can create</a>;
                                        <?php }?>
                                        </ul><div classs="select__list-topic"></div><?php
                                    }
                                                             } ?>
                            <?php if(isset($_GET['do']) && $_GET['do']  == 'subtopics' && Isset($_GET['topic'])) { ?>
                                <div class="admin__create">
                                <h2 class="title_fz-34 admin__title-create">Create Subtopic:</h2>
                                    <form action="../functions/createEntity/createSubtopic.php" method="POST">
                                    <label for="SubTopicName">
                                            <p>Subtopic name</p>
                                            <input required type="text" <?php validationErrorAttr('SubTopicName'); ?>  name="SubTopicName" placeholder="SubTopic name" id="SubTopicName" value="<?php echo old('SubTopicName') ?>">
                                                <?php if(hasValidationError('SubTopicName')): ?>
                                                        <small><?php validationErrorMessage('SubTopicName'); ?></small>
                                                    <?php endif;?>
                                        </label>
                                        <label for="SubTopicDescription">
                                            <p>Description</p>
                                            <input required type="text" <?php validationErrorAttr('SubTopicDescription'); ?>  name="SubTopicDescription" placeholder="SubTopic description" id="SubTopicDescription" value="<?php echo old('SubTopicDescription') ?>">
                                                <?php if(hasValidationError('SubTopicDescription')): ?>
                                                        <small><?php validationErrorMessage('SubTopicDescription'); ?></small>
                                                    <?php endif;?>
                                        </label>
                                        <label for="SubTopicMetaDescription">
                                            <p>Meta description</p>
                                            <input required type="text" <?php validationErrorAttr('SubTopicMetaDescription'); ?>  name="SubTopicMetaDescription" placeholder="This is about..." id="SubTopicMetaDescription" value="<?php echo old('SubTopicMetaDescription') ?>">
                                                <?php if(hasValidationError('SubTopicMetaDescription')): ?>
                                                        <small><?php validationErrorMessage('SubTopicMetaDescription'); ?></small>
                                                    <?php endif;?>
                                        </label>
                                        <label for="SubTopicMetaKeywords">
                                            <p>Meta keywords</p>
                                            <input required type="text" <?php validationErrorAttr('SubTopicMetaKeywords'); ?>  name="SubTopicMetaKeywords" placeholder="keyword 1, keyword 2, ..." id="SubTopicMetaKeywords" value="<?php echo old('SubTopicMetaKeywords') ?>">
                                                <?php if(hasValidationError('SubTopicMetaKeywords')): ?>
                                                        <small><?php validationErrorMessage('SubTopicMetaKeywords'); ?></small>
                                                    <?php endif;?>
                                        </label>
                                        <label for="SelectedTopicName">
                                        <p>Topic</p>
                                        <select required type="text" <?php validationErrorAttr('SelectedTopicName'); ?>  name="SelectedTopicName" placeholder="Subject topic" id="SelectedTopicName">
                                                    <?php foreach ($topics as $topic) { 
                                                        if($topic['name'] == $_GET['topic']) {?>
                                                    <option value="<?php echo $topic['name']  ?>"><?php echo $topic['name'] ?></option>
                                                    <?php } }?>
                                        </select>
                                        </label>
                                        <button type="submit">Add</button>
                                    </form>
                                    <div class="admin__list">
                                        <table>
                                            <tr><th>Subtopic</th><th>Topic</th><th>Course</th><th>Subject</th><th>Delete</th><th>Update</th></tr> 
                                        <?php foreach ($subtopics as $subtopic) { ?> 
                                            <tr>
                                                <td><?php echo $subtopic['name'] ?></td>
                                                <td><?php echo $subtopic['topic'] ?></td>
                                                <td><?php foreach ($topics as $topic) { 
                                                    if ($topic['name']==$subtopic['topic']){
                                                        echo $topic['course'];
                                                        foreach ($courses as $course) { 
                                                            if ($course['name']==$topic['course']){
                                                                echo '<td>' .$course['subject'] . '</td>';
                                                            }
                                                        }
                                                    }
                                                    
                                                } ?></td>
                                                <td><a href="/EducationPlatform/functions/deleteEntity/deleteSubTopic.php?subtopic=<?php echo $subtopic['name']; ?>" class="admin__btn-delete" class="admin__btn-delete" class="admin__btn-delete">Delete</a></td>
                                                <td><a href="/EducationPlatform/admin/admin.php?update_subtopic=<?php echo $subtopic['name']; ?>" class="admin__btn-edit">Update</a></td>
                                            </tr>
                                        <?php } ?>
                                        
                                    </div>
                                    </table>
                                </div>    
                            <?php } ?>
                            <?php if (!empty($_GET['update_question'])) { ?>
                                <h2>Edit question <?php echo $_GET['update_question'] ?></h2>
                                <form action="../functions/updateEntity/updateQuestion.php" method="POST" enctype="multipart/form-data">
                                <?php foreach ($questions as $question) {
                                 if ($question['id'] == $_GET['update_question']) {  ?>
                                    <p>Question title</p>
                                    <p><input type="text" required name="QuestionTitle" value="<?php echo $question['title']?>" placeholder="Course name"><br></p>
                                    <p>Question image<input type="file" required name = "QuestionImgg" value="<?php echo $question['imgQuestion']?>"></p>
                                    <p><input type="hidden" name="QuestionId" value="<?php echo $question['id'] ?>"></p>
                                    <p>Meta description</p>
                                    <p><input type="text" required name="QuestionMetaDescription" value="<?php echo $question['metaDescription'] ?>"></p>
                                    <p>Meta keywords</p>
                                    <p><input type="text" required name="QuestionMetaKeywords" value="<?php echo $question['metaKeywords'] ?>"></p>
                                <?php } } ?>
                                <button type="submit">Edit</button>
                                 </form>
                                    <?php }?>

                                    <?php if(isset($_GET['do']) && $_GET['do']  == 'questions' && !Isset($_GET['subtopic'])) {
           echo "<h1>Select subtopic by topic to create</h1>";
           $i=1; 
           
           foreach ($subjects as $subject) { ?>
           <h6 class="select__title-subject"><?php echo $i.") Subject: " .$subject['name']; $i++;?></h6>
           <div class="select__title-course"><?php echo "Courses:" ?></div>
               <ul class="select__list-course">
               <?php 
               $courseTitle = '';
               foreach ($courses as $course) {?> 
                   
                   
                   <?php if($subject['name'] == $course['subject']) 
                    { $courseTitle='yes';?>
                   
                       <li><a href="?do=topics&course=<?php echo $course['name'] ?>&subject=<?php echo $subject['name'] ?>"><?php echo $course['name'] ?></a></li>
                    
                       <div class="select__title-topic"><?php echo "Topics:" ?></div>
                       
                       <ul class="select__list-topic">
                      
                   <?php $topicTitle=''; foreach ($topics as $topic) {
                       
                       if($course['name'] == $topic['course']){ 
                           $topicTitle='yes';?>
                           <li><a href="?do=subtopics&topic=<?php echo $topic['name'] ?>"><?php echo $topic['name'] ?></a></li>
                           <div class="select__title-subtopic"><?php echo "Subtopics:" ?></div>
                           <ul class="select__list-subtopic"> 
                               <?php
                                   $subtopicTitle = '';
                                   foreach ($subtopics as $subtopic) {
                                       if ($subtopic['topic'] == $topic['name']) { ?>
                                           <li><?php echo $subtopic['name'] ?></li>
                                           <?php $subtopicTitle = 'yes'; ?>
                                           <div class="select__title-question"><?php echo "Questions:" ?></div>
                                           <ul class="select__list-question"> 
                                               <?php 
                                               $questionTitle = '';
                                                   foreach ($questions as $question) {
                                                       
                                                       if ($question['subTopic']==$subtopic['name']) { ?>
                                                           <li><?php echo $question['title'] ?></li>
                                                           
                                                       <?php $questionTitle='sada'; } 
                                                       
                                                   }
                                                   if (!$questionTitle) { ?>
                                                       <a href="?do=questions&subtopic=<?php echo $subtopic['name']; ?>">there`sssss nothing, but you can create</a>;
                                                   <?php }
                                               ?>
                                      </ul> <?php } 
                                   } if (!$subtopicTitle){ ?>
                                       <a href="?do=subtopics&topic=<?php echo $topic['name']; ?>">there`s nothing, but you can create</a>;
                                   <?php }
                               ?>
                           </ul>
                      <?php }
                       
                   } if (!$topicTitle) { ?>
                       <a href="?do=topics&course=<?php echo $course['name']; ?>&subject=<?php echo $subject['name']; ?>">there`s nothinggg, but you can create</a>;
                   <?php }?>
                   </ul><?php
               }  ?>
                   
               <?php
                   }  if(!$courseTitle) { ?>
                       <a href="?do=courses">there`s nothinggg, but you can create</a>;
                   <?php }?>
                   </ul><div classs="select__list-topic"></div><?php
               }
                                        } ?>
                                    <?php if(isset($_GET['do']) && $_GET['do']  == 'questions' && isset($_GET['subtopic'])) { ?>
                                        <div class="admin__create">
                                        <h2 class="title_fz-34 admin__title-create">Create Question:</h2>
                                            <form action="../functions/createEntity/createQuestion.php" method="POST" enctype="multipart/form-data">
                                            <p>Question title</p>
                                            <p><input required type="text" name="QuestionTitle" placeholder="title" value="<?php echo old('QuestionTitle') ?>"><br></p>
                                                <label for="QuestionImg">
                                                    <p>Question image</p>
                                                    <input required type="file" <?php validationErrorAttr('QuestionImg'); ?>  name="QuestionImg" id="QuestionImg">
                                                        <?php if(hasValidationError('QuestionImg')): ?>
                                                                <small><?php validationErrorMessage('QuestionImg'); ?></small>
                                                            <?php endif;?>
                                                </label>
                                                <label for="QuestionMetaDescription">
                                                    <p>Meta description</p>
                                                    <input required type="text" <?php validationErrorAttr('QuestionMetaDescription'); ?>  name="QuestionMetaDescription" id="QuestionMetaDescription">
                                                        <?php if(hasValidationError('QuestionMetaDescription')): ?>
                                                                <small><?php validationErrorMessage('QuestionMetaDescription'); ?></small>
                                                            <?php endif;?>
                                                </label>
                                                <label for="QuestionMetaKeywords">
                                                    <p>Meta keywords</p>
                                                    <input required type="text" <?php validationErrorAttr('QuestionMetaKeywords'); ?>  name="QuestionMetaKeywords" id="QuestionMetaKeywords">
                                                        <?php if(hasValidationError('QuestionMetaKeywords')): ?>
                                                                <small><?php validationErrorMessage('QuestionMetaKeywords'); ?></small>
                                                            <?php endif;?>
                                                </label>
                                                <label for="SelectedSubTopicName">
                                                    <p>Subtopic</p>
                                                <select required type="text" <?php validationErrorAttr('SelectedSubTopicName'); ?>  name="SelectedSubTopicName" id="SelectedSubTopicName">
                                                            <?php foreach ($subtopics as $subtopic) { 
                                                                if ($subtopic['name'] == $_GET['subtopic']) {?>
                                                            <option value="<?php echo $subtopic['name']  ?>"><?php echo $subtopic['name'] ?></option>
                                                            <?php }}?>
                                                </select>
                                                </label>
                                                
                                                <button type="submit">Add</button>
                                            </form>

                                            <div class="admin__list">
                                            
                                                <table>
                                                    <tr><th>Question</th><th>Subtopic</th><th>Topic</th><th>Delete</th><th>Update</th></tr> 
                                                <?php foreach ($questions as $question) { ?> 
                                                    <tr>
                                                        <td><?php echo $question['title']; ?></td>
                                                        <td><?php echo $question['subTopic']; ?></td>
                                                        <td><?php foreach ($subtopics as $subtopic) { 
                                                            if ($subtopic['name']==$question['subTopic']){
                                                        echo $subtopic['topic'];}
                                                        } ?></td>
                                                        <td><a href="/EducationPlatform/functions/deleteEntity/deleteQuestion.php?question=<?php echo $question['id']; ?>" class="admin__btn-delete" class="admin__btn-delete">Delete</a></td>
                                                        <td><a href="/EducationPlatform/admin/admin.php?update_question=<?php echo $question['id']; ?>" class="admin__btn-edit">Update</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </div>
                                            </table>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($_GET['update_section'])) { ?>
                                <h2>Edit section <?php echo $_GET['update_section'] ?></h2>
                                <form action="../functions/updateEntity/updateSection.php" method="POST" enctype="multipart/form-data">
                                <?php
                                    foreach($selections as $section) {
                                        if($section['name'] == 'a' && $section['id_question']) { ?>
                                                <div class="item" style="
                                                <?php $_SESSION['count']=9; if ($_SESSION['count']==0 || $_SESSION['count']==1 || $_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section a</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" name="title_a" value="<?php echo $section['title']; ?>" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_a"><br></p>  
                                                        <p><input type="hidden" value="a" name="a"><br></p>
                                                    </div>
                                        <?php }
                                    }
                                ?>


<?php
                                    foreach($selections as $section) {
                                        if($section['name'] == 'b' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==1 || $_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section b</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" name="title_b" value="<?php echo $section['title']; ?>" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_b"><br></p>  
                                                        <p><input type="hidden" value="b" name="b"><br></p>
                                                    </div>
                                                <?php }} ?>
                                                <?php foreach($selections as $section) {
                                                        if($section['name'] == 'c' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section c</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title'] ?>" name="title_c" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_c"><br></p>  
                                                        <p><input type="hidden" value="c" name="c"><br></p>
                                                    </div>
                                                    <?php }} ?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'd' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section d</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title']; ?>" name="title_d" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_d"><br></p>  
                                                        <p><input type="hidden" value="d" name="d"><br></p>
                                                    </div>
                                                    <?php }} ?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'e' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section e</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title'] ?>" name="title_e" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_e"><br></p>  
                                                        <p><input type="hidden" value="e" name="e"><br></p>
                                                    </div>
                                                    <?php }} ?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'f' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section f</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title']?>" name="title_f" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_f"><br></p>  
                                                        <p><input type="hidden" value="f" name="f"><br></p>
                                                    </div>
                                                    <?php }}?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'g' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section g</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title'] ?>" name="title_g" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_g"><br></p>  
                                                        <p><input type="hidden" value="g" name="g"><br></p>
                                                    </div>
                                                    <?php }}?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'h' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section h</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title']?>" name="title_h" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_h"><br></p>  
                                                        <p><input type="hidden" value="h" name="h"><br></p>
                                                    </div>
                                                    <?php }}?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'i' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section i</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" name="title_i" value="<?php echo $section['title'] ?>" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_i"><br></p>  
                                                        <p><input type="hidden" value="i" name="i"><br></p>
                                                    </div>
                                                    <?php }} ?>
                                                    <?php foreach($selections as $section) {
                                                        if($section['name'] == 'j' && $section['id_question']) { ?>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section j</b></p>
                                                        <p>Title</p>
                                                        <p><input type="text" value="<?php echo $section['title']?>" name="title_j" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_j"><br></p>  
                                                        <p><input type="hidden" value="j" name="j"><br></p>
                                                    </div>
                                                    <?php }} ?>
                                                    <?php $i=0; while ($i <=  $_SESSION['count']) {?>
                                                        
                                                    <?php $i++; } ?>
                                                    <p>Question</p>
                                                    <select required type="text" name="SelectedQuestionId" id="SelectedQuestionId">
                                                                <?php foreach ($questions as $question) { ?>
                                                                <option value="<?php echo $question['id']  ?>"><?php echo $question['title'] ?></option>
                                                                <?php }?>
                                                    </select>
                                                    <button type="submit">Create</button>
                                            </form>
                                    <?php }?>
                                    <?php if(isset($_GET['do']) && $_GET['do']  == 'sections' && !Isset($_GET['questionTitle'])) {
                                            echo "<h1>Select question by subtopic to create</h1>";
                                            $i=1; 
                                            
                                            foreach ($subjects as $subject) { ?>
                                            <h6 class="select__title-subject"><?php echo $i.") Subject: " .$subject['name']; $i++;?></h6>
                                            <div class="select__title-course"><?php echo "Courses:" ?></div>
                                                <ul class="select__list-course">
                                                <?php 
                                                $courseTitle = '';
                                                foreach ($courses as $course) {?> 
                                                    
                                                    
                                                    <?php if($subject['name'] == $course['subject']) 
                                                     { $courseTitle='yes';?>
                                                    
                                                        <li><a href="?do=topics&course=<?php echo $course['name'] ?>&subject=<?php echo $subject['name'] ?>"><?php echo $course['name'] ?></a></li>
                                                     
                                                        <div class="select__title-topic"><?php echo "Topics:" ?></div>
                                                        
                                                        <ul class="select__list-topic">
                                                       
                                                    <?php $topicTitle=''; foreach ($topics as $topic) {
                                                        
                                                        if($course['name'] == $topic['course']){ 
                                                            $topicTitle='yes';?>
                                                            <li><a href="?do=subtopics&topic=<?php echo $topic['name'] ?>"><?php echo $topic['name'] ?></a></li>
                                                            <div class="select__title-subtopic"><?php echo "Subtopics:" ?></div>
                                                            <ul class="select__list-subtopic"> 
                                                                <?php
                                                                    $subtopicTitle = '';
                                                                    foreach ($subtopics as $subtopic) {
                                                                        if ($subtopic['topic'] == $topic['name']) { ?>
                                                                            <li><a href="?do=questions&subtopic=<?php echo $subtopic['name'] ?>"><?php echo $subtopic['name'] ?></a></li>
                                                                            <?php $subtopicTitle = 'yes'; ?>
                                                                            <div class="select__title-question"><?php echo "Questions:" ?></div>
                                                                            <ul class="select__list-question"> 
                                                                                <?php 
                                                                                $questionTitle = '';
                                                                                    foreach ($questions as $question) {
                                                                                        
                                                                                        if ($question['subTopic']==$subtopic['name']) { ?>
                                                                                            <li><a href="?do=sections&questionTitle=<?php echo $question['title'] ?>"><?php echo $question['title'] ?></a></li>
                                                                                            
                                                                                        <?php $questionTitle='sada'; } 
                                                                                        
                                                                                    }
                                                                                    if (!$questionTitle) { ?>
                                                                                        <a href="?do=questions&subtopic=<?php echo $subtopic['name']; ?>">there`sssss nothing, but you can create</a>;
                                                                                    <?php }
                                                                                ?>
                                                                       </ul> <?php } 
                                                                    } if (!$subtopicTitle){ ?>
                                                                        <a href="?do=subtopics&topic=<?php echo $topic['name']; ?>">there`s nothing, but you can create</a>;
                                                                    <?php }
                                                                ?>
                                                            </ul>
                                                       <?php }
                                                        
                                                    } if (!$topicTitle) { ?>
                                                        <a href="?do=topics&course=<?php echo $course['name']; ?>&subject=<?php echo $subject['name']; ?>">there`s nothinggg, but you can create</a>;
                                                    <?php }?>
                                                    </ul><?php
                                                }  ?>
                                                    
                                                <?php
                                                    }  if(!$courseTitle) { ?>
                                                        <a href="?do=courses">there`s nothinggg, but you can create</a>;
                                                    <?php }?>
                                                    </ul><div classs="select__list-topic"></div><?php
                                                }
                                        } ?>
                                    <?php if(isset($_GET['do']) && $_GET['do']  == 'sections' && isset($_GET['questionTitle'])) { ?>
                                        <div class="admin__create">
                                        <h2 class="title_fz-34 admin__title-create">Create Section:</h2>
                                        
                                        <?php 
                                                $althabet = ['a','b','c','d','e','f','g','h','i','j'];
                                                if (!isset($_SESSION['count'])) {
                                                    $_SESSION['count'] = 0;
                                                }

                                                if (isset($_POST['increment']) && isset($_SESSION['count']) && $_SESSION['count']<9) {
                                                    $_SESSION['count']++;
                                                }
                                                if (isset($_POST['unincrement']) && isset($_SESSION['count']) && $_SESSION['count']>=1) {
                                                    $_SESSION['count']--;
                                                }

                                                echo "Count: " . 1+$_SESSION['count'];
                                                ?>
                                                <div class="section__wrap">
                                                <form method="post">
                                                    <button type="submit" name="increment">Add</button>
                                                </form>
                                                <form method="post">
                                                    <button type="submit" name="unincrement">Delete</button>
                                                </form>
                                            </div>

                                                <form action="../functions/createEntity/createSection.php" method="POST" enctype="multipart/form-data">
                                                <div class="item" style="
                                                <?php if ($_SESSION['count']==0 || $_SESSION['count']==1 || $_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section a</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_a" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_a"><br></p>  
                                                        <p><input type="hidden" value="a" name="a"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==1 || $_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section b</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_b" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_b"><br></p>  
                                                        <p><input type="hidden" value="b" name="b"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==2 || $_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section c</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_c" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_c"><br></p>  
                                                        <p><input type="hidden" value="c" name="c"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==3 || $_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section d</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_d" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_d"><br></p>  
                                                        <p><input type="hidden" value="d" name="d"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==4 || $_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section e</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_e" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_e"><br></p>  
                                                        <p><input type="hidden" value="e" name="e"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==5 || $_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section f</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_f" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_f"><br></p>  
                                                        <p><input type="hidden" value="f" name="f"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==6 || $_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section g</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_g" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_g"><br></p>  
                                                        <p><input type="hidden" value="g" name="g"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==7 || $_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section h</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_h" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_h"><br></p>  
                                                        <p><input type="hidden" value="h" name="h"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==8 || $_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section i</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_i" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_i"><br></p>  
                                                        <p><input type="hidden" value="i" name="i"><br></p>
                                                    </div>
                                                    <div class="item" style="
                                                <?php if ($_SESSION['count']==9) {
                                                     echo ("display: block;");
                                                     } else { 
                                                        echo "display:none;"; 
                                                        } ?>">
                                                        <p><b>section j</b></p>
                                                        <p>Title image</p>
                                                        <p><input type="file" name="title_j" placeholder="Title"><br></p>
                                                        <p>Answer image</p>
                                                        <p><input type="file" name="answerImg_j"><br></p>  
                                                        <p><input type="hidden" value="j" name="j"><br></p>
                                                    </div>
                                                    <?php $i=0; while ($i <=  $_SESSION['count']) {?>
                                                        
                                                    <?php $i++; } ?>
                                                    <p>Question</p>
                                                    <select required type="text" name="SelectedQuestionId" id="SelectedQuestionId">
                                                                <?php foreach ($questions as $question) { 
                                                                    if ($question['title']==$_GET['questionTitle']) {?>
                                                                <option value="<?php echo $question['id']  ?>"><?php echo $question['title'] ?></option>
                                                                <?php } }?>
                                                    </select>
                                                    <button type="submit">Create</button>
                                                </form>
                                                
                                            <div class="admin__list">
                                            
                                                <table>
                                                    <tr><th>Selection</th><th>title</th><th>Question</th><th>Update</th></tr> 
                                                <?php foreach ($selections as $selection) { ?> 
                                                    <tr>
                                                        <td><?php echo $selection['name']; ?></td>
                                                        <td><?php
                                                        if($selection['title']){
                                                            echo $selection['title'];
                                                        } else {
                                                            echo "unset";
                                                        } ?></td>
                                                        <td><?php foreach ($questions as $question) { 
                                                            if ($question['id']==$selection['id_question']){
                                                        echo $question['title'];}
                                                        } ?></td>
                                                        <td><a href="/EducationPlatform/admin/admin.php?update_section=<?php echo $selection['id_question']; ?>" class="admin__btn-edit">Update</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </div>
                                            </table>
                                        </div>
                                    <?php } ?>
                    </div>
            
            
                        
                   
            </div>
           
           
                
                
            </div>
        </div>
    </div>
</div>












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