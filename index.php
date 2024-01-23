<?php
    require_once 'functions/db.php';
    require_once 'templates/stylelink.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("main"); ?>">
    <title>Education Platform</title>
</head>
<body>
    <?php 
        
        require_once "templates/header.php";
    ?>
    <section class="promo">
        <h1 class="promo__title">The best question bank!</h1>
        <h2 class="promo__subtitle">Practice solving tasks of different difficulty levels</h2>
        <div class="promo__text">Teachers and students have recognized our No. 1 resource</div>
        <div class="promo__wrap">
        <?php 
            $select = "SELECT `name` FROM `subject`";
            $query = mysqli_query($db,$select);
            $subjects = mysqli_fetch_all($query, MYSQLI_ASSOC);//запрос и аргумент для ассоциативного показа
            
              foreach ($subjects as $subject) { ?>
                    <div class="promo__subject">
                        <h3 class="promo__subject-title"><?php echo $subject['name']; ?></h3>
                        <div class="promo__subjects">
                        <?php 
                            $select = "SELECT name FROM course WHERE subject = '{$subject['name']}'";
                            $query = mysqli_query($db, $select);
                            $courses = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            foreach ($courses as $course) { ?>
                                <div class="promo__subject-item">
                                    <a href="course/?name=<?php echo $course['name'] ?>"><?php echo $course['name'] ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
              <?php } ?>
        </div>
    </section>
    
    <?php
        require_once "templates/footer.php";
    ?>
</body>
</html>