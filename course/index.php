<?php 
require_once '../functions/db.php';

if (isset($_GET['name'])) {
    $courseName = $_GET['name'];
    
    $select = "SELECT name, description, successTips, subject FROM course WHERE name='$courseName'";
    $query = mysqli_query($db, $select);
    
    $course = mysqli_fetch_assoc($query);

    echo $course["name"] . "<br>"; 
    echo $course["description"] . "<br>"; 
    echo $course["successTips"] . "<br>"; 
    echo $course["subject"] . "<br>";
}
?>


<a href="topic.php?name=<?php echo $course['name'] ?>">click</a>