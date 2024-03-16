<?php
    require_once '../db.php';
    if (!empty($_GET['subtopic'])) {
        $name = mysqli_real_escape_string($db,$_GET['subtopic']);
        $delete = "DELETE FROM subtopic WHERE `name` = '$name'";
        $query = mysqli_query($db,$delete);


        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=subtopics');
        else echo "ошибка удалени";
    }