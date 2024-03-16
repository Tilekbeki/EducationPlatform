<?php session_start(); 
require_once '../functions/db.php';
require_once '../functions/form/helper.php';
checkGuest();
?>
<!DOCTYPE html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="auth__header">
        <div class="container">
            Reset
        </div>
    </nav>
    <main>
        <div class="content">
            <div class="container">
                <div class="content-body">
                    <?php if (isset($_GET["reset_token"]) && isset($_GET["email"])){ ?>
                        <form action="../functions/form/reset.php" method="POST">
                            <p>Enter new password</p>
                            <p><input requred name="newPassword" type="password" size="30" placeholder="password" /></p>
                            <p>Repeat password</p>
                            <p><input requred name="repeatedPassword" type="password" size="30" placeholder="password" /></p>
                            <p><input type="submit" value="Отправить"/></p>
                        </form> 
                    <?php } else {
                        echo "Invalid link";
                     } ?>
                </div>
            </div>
        </div>
    </main>
<?php require_once '../templates/footer.php'; ?>
</body>
</html>