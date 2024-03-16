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
    <title>Forget password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="auth__header">
        <div class="container">
            Forget
        </div>
    </nav>
    <main>
        <div class="content">
            <div class="container">
                <div class="content-body">
                    <form name="form1" method="post" action="../mailer/smart.php">
                        <p>Enter the email address to which the password reset link will be sent</p>
                        <input requred name="email" type="email" size="50" placeholder="email" />
                        <p>
                            <input type="submit" value="Send link" size="30">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php require_once '../templates/footer.php'; ?>
</body>
</html>