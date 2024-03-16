<?php
    require_once '../db.php';
    if (!empty($_GET['subject'])) {
        $name = mysqli_real_escape_string($db,$_GET['subject']);
        $delete = "DELETE FROM subject WHERE `name` = '$name'";
        $query = mysqli_query($db,$delete);
        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=subjects');
        else echo "ошибка удалени";
    }