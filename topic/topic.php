<?php
require_once '../functions/db.php';
require_once '../templates/stylelink.php';

require_once '../functions/form/helper.php';
if (isset($_GET['name'])) {
    $topicName = $_GET['name'];
    
    $select = "SELECT name, price, course,metaKeywords,id FROM topic WHERE name='$topicName'";
    $topics = mysqli_query($db, $select);
    $topics = mysqli_fetch_all($topics, MYSQLI_ASSOC); 
    
} else {
    redirect('/EducationPlatform');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
   
    
    <title>Topics of <?php echo $topicName ?></title>
</head>
<body>
<?php require_once '../templates/header.php'; ?>
<section class="topics">
    <div class="container">
    <h1 class="title_orange title_fz48 course__topics-title">Topic: <?php echo $topicName ?></h1>
       <div class="topics__list">
        <?php foreach ($topics as $topic) { ?>
                    <div class="topics__topic">
                        <h3 class="title_fz36 topics__topic-title" id="<?php echo $topic["id"];?>">Topic <?php echo $topic["name"]; ?></h3>
                        <div class="topics__wrap">
                            <?php
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



