<?php
require_once '../functions/db.php';

$metaKeywords = $_POST['descr'];

$select1 = "SELECT `name`, `course`,`id` FROM `topic` WHERE metaKeywords LIKE '%$metaKeywords%'";
$query1 = mysqli_query($db,$select1);

$select2 = "SELECT `name`,`topic` FROM `subtopic` WHERE metaKeywords LIKE '%$metaKeywords%'";
$query2 = mysqli_query($db,$select2);

$select3 = "SELECT `title`,`subTopic` FROM `question` WHERE metaKeywords LIKE '%$metaKeywords%'";
$query3 = mysqli_query($db,$select3);

$data = [];
while($row = mysqli_fetch_assoc($query1)) {
    array_push($data, "<div class='entity'><div class='entity__name'>". $row['name'] . "</div> <a class='button_orange entity__link' href='/EducationPlatform/course/topic.php?name=". $row['course'] ."#" .  $row['id']."'>view topic</a></div>");
}

while($row = mysqli_fetch_assoc($query2)) {
    array_push($data, "<div class='entity'><div class='entity__name'>". $row['name'] . "</div> <a class='button_orange entity__link' href='/EducationPlatform/questions/questions.php?subtopicname=". $row['name'] ."'>view subtopic</a></div>");}

while($row = mysqli_fetch_assoc($query3)) {
    array_push($data, "<div class='entity'><div class='entity__name'>". $row['title'] . "</div> <a class='button_orange entity__link' href='/EducationPlatform/questions/questions.php?subtopicname=hh". $row['subTopic'] ."'>view question</a></div>");}

echo implode(" ", $data);
?>