<?php
    require_once '../db.php';
    if (!empty($_GET['topic'])) {
        $name = mysqli_real_escape_string($db,$_GET['topic']);
        $delete = "DELETE FROM topic WHERE `name` = '$name'";
        $query = mysqli_query($db,$delete);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=topics');
        else echo "ошибка удалени";
    }