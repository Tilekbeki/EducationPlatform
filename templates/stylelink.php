<?php 
$link = '';
function returnLink ($page) {
    

    if ($page == "main") {
        return $link = "assets/css/style.css";
    } elseif ($page == "another") {
        return $link = "../assets/css/style.css";
    }
}

?>