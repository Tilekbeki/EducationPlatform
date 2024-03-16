<?php 
require_once '../functions/db.php';
require_once '../templates/stylelink.php';
require_once '../functions/form/helper.php';


if (isset($_GET['name'])) {
    $courseName = $_GET['name'];
    
    $select = "SELECT name, description, successTips, subject FROM course WHERE name='$courseName'";
    $query = mysqli_query($db, $select);
    
    $course = mysqli_fetch_assoc($query);

    // echo $course["name"] . "<br>"; 
    // echo $course["description"] . "<br>"; 
    // echo $course["successTips"] . "<br>"; 
    // echo $course["subject"] . "<br>";
}else {
    redirect('/EducationPlatform');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <title>Questions <?php echo $courseName; ?></title>
</head>
<body>
    <?php require_once '../templates/header.php'; ?>
    <div class="course">
        
        <div class="container">
        <h1 class="title_orange title_fz48 course__subject-title">Subject: <?php echo $course["subject"] ?></h1>
            <div class="course__content">
            <h1 class="title_fz36 course__title">Course: <?php echo $courseName = $_GET['name']; ?></h1>
                <div class="course__descr">
                    <h2 class="course__descr-title title_fz36">Description</h2>
                    <div class="course__descr-text">
                        <?php echo $course["description"] ?>
                    </div>
                </div>
                <div class="course__successTips">
                <h2 class="course__successTips-title title_fz36">Tips for Success</h2>
                    <div class="course__successTips-text">
                        <?php echo $course["successTips"] ?>
                    </div>
                </div>
                <div class="course__topics">
                    <h2 class="title_fz36 course__topics-title">Structure</h2>
            <?php 
                $select = "SELECT `name`,price FROM `topic` WHERE course = '$courseName'";
                $query = mysqli_query($db,$select);
                $topics = mysqli_fetch_all($query, MYSQLI_ASSOC);//запрос и аргумент для ассоциативного показа
                $i = 1;
                foreach ($topics as $topic) { ?>
                        <div class="course__topics-item">
                            <h4 class="course__item-title"><span><?php echo $i; $i++; ?></span> <?php  echo $topic['name']; ?>
                        
                        </h4>
                            
                </div><?php } ?>
                </div>
                
                <a href="topic.php?name=<?php echo $course['name'] ?>" class="button_orange course__getStart">Review</a>
            </div>
            
        </div>
    </div>
<?php require_once '../templates/footer.php'; ?>