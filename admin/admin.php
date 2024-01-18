

<h2>Create Subject:</h2>
<form action="../functions/createEntity/createSubject.php" method="POST">
    <p><input type="text" name="name" placeholder="Subject name"><br></p>
    <button type="submit">Add</button>
</form>


<h2>Create Course:</h2>
<form action="../functions/createEntity/createCourse.php" method="POST">
    <p><input type="text" name="name" placeholder="Course name"><br></p>
    <p><input type="text" name="description" placeholder="description"><br></p>
    <p><input type="text" name="successTips" placeholder="successTips"><br></p>
    <p><input type="text" name="subject" placeholder="subject"><br></p>
    <button type="submit">Add</button>
</form>


<h2>Create Topic:</h2>
<form action="../functions/createEntity/createTopic.php" method="POST">
    <p><input type="text" name="name" placeholder="Topic name"><br></p>
    <p><input type="text" name="price" placeholder="price"><br></p>
    <p><input type="text" name="course" placeholder="course"><br></p>
    <button type="submit">Add</button>
</form>

<h2>Create Subtopic:</h2>
<form action="../functions/createEntity/createSubtopic.php" method="POST">
    <p><input type="text" name="name" placeholder="Subtopic name"><br></p>
    <p><input type="text" name="description" placeholder="description"><br></p>
    <p><input type="text" name="topic" placeholder="topic"><br></p>
    <button type="submit">Add</button>
</form>

<h2>Create Question:</h2>
<form action="../functions/createEntity/createQuestion.php" method="POST" enctype="multipart/form-data">
<p><input type="text" name="title" placeholder="title"><br></p>
    <p><input type="file" name="imgQuestion" value="upload"><br></p>
    <p><input type="file" name="imgAnswer" value="upload"><br></p>
    <p><input type="text" name="subtopic" placeholder="subtopic"><br></p>
    <button type="submit">Add</button>
</form>


<?php
    require_once '../functions/db.php';
    if (!empty($_GET)) {
        $title = $_GET['title'];
        $subtopic = $_GET['subtopic'];
        $select = "SELECT `id` FROM `question` ORDER BY id DESC LIMIT 1";
        echo ($_GET['title']);
        echo ($_GET['subtopic']);
        
        $query = mysqli_query($db,$select);
        $question = mysqli_fetch_assoc($query);
        $questionId = (int) $question['id'];
        // var_dump($questionId);

        $insertInSubtopicquestion = "INSERT INTO subtopicquestion (`subtopic`, `id_question`) VALUES('$subtopic', '$questionId')";
        $query2 = mysqli_query($db,$insertInSubtopicquestion);
        if ($query2) {
            header("Location: /EducationPlatform/admin/admin.php"); 
        } else {
            echo "пиздец";
        }


    }
?>