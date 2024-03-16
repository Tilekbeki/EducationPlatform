<?php
require_once '../functions/db.php';
require_once '../templates/stylelink.php';
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo returnLink ("another"); ?>">
    <title>Search</title>
</head>
<body>
    <?php 
        
        require_once "../templates/header.php";
    ?>
    <div class="search">
        <div class="container">
        <h1>Let's find something!</h1>
            <div class="search-block">
                
                <input id="search-descr" type="text" placeholder="Search by keywords" class="search__input">
                <div class="search-icon">🔍</div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="content-body">
                    <div class="entity__list" id="showdata">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
"></script>
<script>
    $(document).ready(function(){
        $('#search-descr').on("keyup", function() {
            let getDescr = $(this).val();
            $.ajax({
                method: 'POST',
                url: 'searchAjax.php',
                data: {descr:getDescr},
                success: function(response)
                {
                    $("#showdata").html(response);
                }
            })
        });
    });
</script>

<?php 
        
        require_once "../templates/footer.php";
    ?>