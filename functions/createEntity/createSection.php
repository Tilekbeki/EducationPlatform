<?php
    session_start();
    require_once '../db.php';
    require_once '../form/helper.php';
    $A = trim(strip_tags($_POST['a'])) ?? null;
    $B = trim(strip_tags($_POST['b'])) ?? null;
    $C = trim(strip_tags($_POST['c'])) ?? null;
    $D = trim(strip_tags($_POST['d'])) ?? null;
    $E = trim(strip_tags($_POST['e'])) ?? null;
    $F = trim(strip_tags($_POST['f'])) ?? null;
    $G = trim(strip_tags($_POST['g'])) ?? null;
    $H = trim(strip_tags($_POST['h'])) ?? null;
    $I = trim(strip_tags($_POST['i'])) ?? null;
    $J = trim(strip_tags($_POST['j'])) ?? null;
    $Atitle = isset($_FILES['title_a']['tmp_name']) && !empty($_FILES['title_a']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_a']['tmp_name'])) : null;
    $Btitle =  isset($_FILES['title_b']['tmp_name']) && !empty($_FILES['title_b']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_b']['tmp_name'])) : null;
    $Ctitle = isset($_FILES['title_c']['tmp_name']) && !empty($_FILES['title_c']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_c']['tmp_name'])) : null;
    $Dtitle = isset($_FILES['title_d']['tmp_name']) && !empty($_FILES['title_d']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_d']['tmp_name'])) : null;
    $Etitle = isset($_FILES['title_e']['tmp_name']) && !empty($_FILES['title_e']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_e']['tmp_name'])) : null;
    $Ftitle = isset($_FILES['title_f']['tmp_name']) && !empty($_FILES['title_f']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_f']['tmp_name'])) : null;
    $Gtitle = isset($_FILES['title_g']['tmp_name']) && !empty($_FILES['title_g']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_g']['tmp_name'])) : null;
    $Htitle = isset($_FILES['title_h']['tmp_name']) && !empty($_FILES['title_h']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_h']['tmp_name'])) : null;
    $Ititle = isset($_FILES['title_i']['tmp_name']) && !empty($_FILES['title_i']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_i']['tmp_name'])) : null;
    $Jtitle = isset($_FILES['title_j']['tmp_name']) && !empty($_FILES['title_j']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['title_j']['tmp_name'])) : null;
    $answerImgA = isset($_FILES['answerImg_a']['tmp_name']) && !empty($_FILES['answerImg_a']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_a']['tmp_name'])) : null;
    $answerImgB = isset($_FILES['answerImg_b']['tmp_name']) && !empty($_FILES['answerImg_b']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_b']['tmp_name'])) : null;
    $answerImgC = isset($_FILES['answerImg_c']['tmp_name']) && !empty($_FILES['answerImg_c']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_c']['tmp_name'])) : null;
    $answerImgD = isset($_FILES['answerImg_d']['tmp_name']) && !empty($_FILES['answerImg_d']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_d']['tmp_name'])) : null;
    $answerImgF = isset($_FILES['answerImg_f']['tmp_name']) && !empty($_FILES['answerImg_f']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_f']['tmp_name'])) : null;
    $answerImgE = isset($_FILES['answerImg_e']['tmp_name']) && !empty($_FILES['answerImg_e']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_e']['tmp_name'])) : null;
    $answerImgH = isset($_FILES['answerImg_h']['tmp_name']) && !empty($_FILES['answerImg_h']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_h']['tmp_name'])) : null;
    $answerImgG = isset($_FILES['answerImg_g']['tmp_name']) && !empty($_FILES['answerImg_g']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_g']['tmp_name'])) : null;
    $answerImgJ = isset($_FILES['answerImg_j']['tmp_name']) && !empty($_FILES['answerImg_j']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_j']['tmp_name'])) : null;
    $answerImgI = isset($_FILES['answerImg_i']['tmp_name']) && !empty($_FILES['answerImg_i']['tmp_name']) ? mysqli_real_escape_string($db,file_get_contents($_FILES['answerImg_i']['tmp_name'])) : null;
    $questionId = mysqli_real_escape_string($db,$_POST['SelectedQuestionId']) ?? null;
    $questionId = (int) $questionId;

    $althabetOfTitles = [$Atitle,$Btitle,$Ctitle,$Dtitle,$Etitle,$Ftitle,$Gtitle,$Htitle,$Ititle,$Jtitle];
    $althabetOfImg = [$answerImgA,$answerImgB,$answerImgC,$answerImgD,$answerImgE,$answerImgF,$answerImgG,$answerImgH,$answerImgI,$answerImgJ];
    
    if ($_POST) {
        //создание таблицы секций
        $updateA = "UPDATE `sectionofquestion` SET `title`='$Atitle',`answerImg`='$answerImgA' WHERE id_question= '$questionId' and name='$A'";
        $updateB = "UPDATE `sectionofquestion` SET `title`='$Btitle',`answerImg`='$answerImgB' WHERE id_question= '$questionId' and name='$B'";
        $updateC = "UPDATE `sectionofquestion` SET `title`='$Ctitle',`answerImg`='$answerImgC' WHERE id_question= '$questionId' and name='$C'";
        $updateD = "UPDATE `sectionofquestion` SET `title`='$Dtitle',`answerImg`='$answerImgD' WHERE id_question= '$questionId' and name='$D'";
        $updateE = "UPDATE `sectionofquestion` SET `title`='$Etitle',`answerImg`='$answerImgE' WHERE id_question = '$questionId' and name='$E'";
        $updateF = "UPDATE `sectionofquestion` SET `title`='$Ftitle',`answerImg`='$answerImgF' WHERE id_question = '$questionId' and name='$F'";
        $updateG = "UPDATE `sectionofquestion` SET `title`='$Gtitle',`answerImg`='$answerImgG' WHERE id_question = '$questionId' and name='$G'";
        $updateH = "UPDATE `sectionofquestion` SET `title`='$Htitle',`answerImg`='$answerImgH' WHERE id_question = '$questionId' and name='$H'";
        $updateI = "UPDATE `sectionofquestion` SET `title`='$Ititle',`answerImg`='$answerImgI' WHERE id_question = '$questionId' and name='$I'";
        $updateJ = "UPDATE `sectionofquestion` SET `title`='$Ftitle',`answerImg`='$answerImgJ' WHERE id_question = '$questionId' and name='$J'";
        
        $query3 = mysqli_query($db,$updateA);
        
        $query4 = mysqli_query($db,$updateB);
        $query5 = mysqli_query($db,$updateC);
        $query6 = mysqli_query($db,$updateD);
        $query7 = mysqli_query($db,$updateE);
        $query8 = mysqli_query($db,$updateF);
        $query9 = mysqli_query($db,$updateG);
        $query10 = mysqli_query($db,$updateH);
        $query11 = mysqli_query($db,$updateI);
        $query12 = mysqli_query($db,$updateJ);
        if ($query3 && $query5 && $query6 && $query7 && $query8 && $query9 && $query10 && $query11 && $query12) header("Location: /EducationPlatform/admin/admin.php?do=sections"); 
    }



