<?php
require_once '../functions/db.php';
require_once '../templates/stylelink.php';
if (isset($_GET['name'])) {
    $courseName = $_GET['name'];
    
    $select = "SELECT name, price, course,metaKeywords,id FROM topic WHERE course='$courseName'";
    $topics = mysqli_query($db, $select);
    $topics = mysqli_fetch_all($topics, MYSQLI_ASSOC); 
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <?php $keywords=[]; foreach ($topics as $topic) { 
            if ($topic['metaKeywords']) {
                array_push($keywords, $topic['metaKeywords']);
         } } $visibleKeys = implode(", ", $keywords);?>
    <meta name="keywords" content="<?php echo $visibleKeys; ?>">
    
    <title>Topics of <?php echo $courseName ?></title>
</head>
<body>
<?php require_once '../templates/header.php'; ?>
<section class="topics">
    <div class="container">
    <h1 class="title_orange title_fz48 course__topics-title">Course: <?php echo $courseName ?></h1>
       <div class="topics__list">
            <?php $catIsHere = true; $i=1; foreach ($topics as $topic) {
                 ?>
                    <div class="topics__topic">
                        <h3 class="title_fz36 topics__topic-title" id="<?php echo $topic["id"];?>">Topic <?php echo $i; ?> <?php echo $topic["name"]; ?></h3>
                        <div class="topics__wrap">
                            <?php
                                $i++;
                                    $topicName = $topic["name"];
                                    $select2 = "SELECT name,  description FROM subtopic WHERE topic='$topicName'";
                                    $subtopics = mysqli_query($db, $select2);
                                    $subtopics = mysqli_fetch_all($subtopics, MYSQLI_ASSOC); 
                                    
                                    foreach ($subtopics as $subtopic) { 
                                        if ($subtopic['name']) {
                                            $catIsHere = false;
                                        
                                         ?>
                                    
                                <a href="/EducationPlatform/questions/questions.php?subtopicname=<?php echo $subtopic["name"];?>" class="topics__topic-item">
                                    <h3 class="topics__item-title"><?php echo $subtopic["name"]; ?></h3>
                                    <div class="topics__item-descr"><?php echo $subtopic["description"]; ?></div>
                                </a>
                            <?php } }?>

                            
                        </div>
                    </div>
            <?php } ?>
            <?php if($catIsHere) {?>
                <div class="coming-soon">
                    <img class="coming-soon__cat" src="../assets/gif/coming soon cat.gif" alt="cat">
                    <h2>Coming soon...</h2>
                </div>
                            <?php } ?>
       </div>
    </div>
</section>
<script src="../assets/js/jquery.min.js"></script>
<script>
    $('.scrollto a').on('click', function() {

    let href = $(this).attr('href');

    $('html, body').animate({
        scrollTop: $(href).offset().top
    }, {
        duration: 370,   // по умолчанию «400» 
        easing: "linear" // по умолчанию «swing» 
    });

    return false;
    });
</script>
<?php require_once '../templates/footer.php'; ?>



