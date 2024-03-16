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
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="auth__header">
    <div class="container">
        LOGIN
    </div>
</nav>
<main>
    <section class="login">
        <div class="content">
            <div class="container">
                <div class="content-body">
                    <div class="welcome-text">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and get start with us</p>
                        <a href="/EducationPlatform/auth/register.php">SignUp</a>
                    </div>
            <form action="../functions/form/log.php" method="POST">
                <?php if(hasMessage('error')): ?>
                    <div class="notice error">
                        <?php echo getMessage('error') ?>
                    </div>
                <?php endif; ?>
                <label for="email">
                    <p>Email</p>
                    <input 
                    type="text"
                    name="email" 
                    <?php validationErrorAttr('email'); ?>
                    placeholder="jonh.smith@mail.com"
                        value="<?php echo old('email') ?>">
                        <?php if(hasValidationError('email')): ?>
                            <small><?php validationErrorMessage('email'); ?></small>
                        <?php endif;?>
                </label>
                <label for="password">
                    <p>Password</p>
                    <input type="password" <?php validationErrorAttr('password'); ?>  name="password" placeholder="password" id="password">
                        <?php if(hasValidationError('password')): ?>
                                <small><?php validationErrorMessage('password'); ?></small>
                            <?php endif;?>
                    </label>
                <button type="submit">LogIn</button>
                <div class="login__extra">
                    <a href="/EducationPlatform/auth/forgot-password.php">Forget Password</a>
                    <a href="/EducationPlatform">Back to main page</a>
                </div>
            </form>
           
                </div>

            </div>
        </div>
    </section>
</main>
<?php require_once '../templates/footer.php'; ?>
</body>
</html>
