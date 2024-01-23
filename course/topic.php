<?php
require_once '../functions/db.php';

if (isset($_GET['name'])) {
    $courseName = $_GET['name'];
    
    $select = "SELECT name, price, course FROM topic WHERE course='$courseName'";
    $query = mysqli_query($db, $select);
    
    
}
?>
<section class="topics">
    <div class="container">
        <?php foreach ($query as $topic) { ?>
            <div class="topics__topic">
                <h3 class="topics__topic-title">Topic: <?php echo $topic["name"]; ?></h3>
                <?php
                    $topicName = $topic["name"];
                 $select2 = "SELECT name,  description FROM subtopic WHERE topic='$topicName'";
                    $query2 = mysqli_query($db, $select2); 
                    foreach ($query2 as $subtopic) { ?>
                <div class="topics__topic-items">
                    <div class="topics__topic-item">subTopic: <?php echo $subtopic["name"]; ?></div>
                    <a href="/questions/questions.php?subtopicname=asdasd">click to see questions</a>
                </div>
                <?php }?>
            </div>
    <?php } ?>
    </div>
</section>



