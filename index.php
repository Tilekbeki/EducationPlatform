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
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <title>Education Platform</title>
</head>
<body>
    <?php 
        
        require_once "templates/header.php";
    ?>
    <section class="promo">
        <div class="container">
            <h1 class="promo__title title title_fz48 wow animate__fadeIn" style="visibility: visible; animation-duration: 5s; animation-name: fadeIn;">The best question bank!</h1>
            <h2 class="promo__subtitle title title_fz20 text-typing wow animate__fadeIn" style="visibility: visible; animation-duration: 5s; animation-name: fadeIn;"><span id="typed"></span></h2>
            <div id="typed-strings">
                <span>Practice solving tasks of different difficulty levels</span>
                <span>The customer support team is also very responsive and helpful</span>
                <span>Majority can't imagine studying for exams without this service</span>
                <span>It has helped a lot of students so much in preparing for their exams</span>
            </div>

            <div class="promo__text wow animate__fadeIn" style="visibility: visible; animation-duration: 5s; animation-name: fadeIn;">Teachers and students have recognized our No. 1 resource</div>
            <div class="promo__wrap">
                <div class="promo__wrap-title">Pick a subject 👇</div>
                <div class="promo__subjects wow animate__fadeInUp" style="visibility: visible; animation-duration: 3s; animation-name: fadeInUp;">
            <?php 
                $select = "SELECT `name` FROM `subject`";
                $query = mysqli_query($db,$select);
                $subjects = mysqli_fetch_all($query, MYSQLI_ASSOC);//запрос и аргумент для ассоциативного показа
                
                foreach ($subjects as $subject) { ?>
                        <div class="promo__subjects-item">
                            <h3 class="promo__subjects-title"><?php echo $subject['name']; ?></h3>
                            <div class="promo__courses">
                            <?php 
                                $select = "SELECT name FROM course WHERE subject = '{$subject['name']}'";
                                $query = mysqli_query($db, $select);
                                $courses = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                if(!$courses) {
                                    echo "Coming soon...";
                                }
                                foreach ($courses as $course) { ?>
                                    <a class="promo__courses-item" href="course/?name=<?php echo $course['name'] ?>"><?php echo $course['name'] ?></a>
                                    
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/wow.min.js">
    </script>
    <script src="assets/js/typed.js"></script>
    <script>
        let typed = new Typed('#typed', { // Тут id того блока, в которм будет анимация
        stringsElement: '#typed-strings', // Тут id блока из которого берем строки для анимации
        typeSpeed: 100, // Скорость печати
        startDelay: 500, // Задержка перед стартом анимации
        backSpeed: 50, // Скорость удаления
        loop: true // Указываем, повторять ли анимацию
});
        new WOW().init();
    </script>
    <?php
        require_once "templates/footer.php";
    ?>
</body>
</html>