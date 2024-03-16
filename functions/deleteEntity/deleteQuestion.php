<?php
    require_once '../db.php';
    if (!empty($_GET['question'])) {
        $id = mysqli_real_escape_string($db,$_GET['question']);
        $delete = "DELETE FROM question WHERE `id` = '$id'";
        $query = mysqli_query($db,$delete);


        if ($query) header('Location: /EducationPlatform/admin/admin.php?do=questions');
        else echo "ошибка удалени";
    }