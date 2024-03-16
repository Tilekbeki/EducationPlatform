<?php
require_once '../functions/db.php';
$select = "SELECT `name` FROM `subject`";
                $query = mysqli_query($db,$select);
                $subjects = mysqli_fetch_all($query, MYSQLI_ASSOC);//запрос и аргумент для ассоциативного показа
?>
<footer class="footer">
    <div class="container">
        <div class="footer__wrap">
            <div class="footer__mainInfo">&copy; Education Platform 2024, All Rights Reserved.</div>
            <div class="footer__subjects">
                <h3>Subjects</h3>
                <ul>
                    <?php foreach ($subjects as $subject) { ?>
                    <li><?php echo $subject['name'];?></li>
                    <?php }?>
                </ul>
            </div>
            <!-- <div class="footer__general">
                fq
            </div> -->
        </div>
    </div>
</footer>