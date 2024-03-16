<?php
    require_once '../db.php';
    if (!empty($_GET['course'])) {
        $name = mysqli_real_escape_string($db,$_GET['course']);
        $delete = "DELETE FROM course WHERE `name` = '$name'";
        $query = mysqli_query($db,$delete);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=courses');
        else echo "ошибка удалени";
    }