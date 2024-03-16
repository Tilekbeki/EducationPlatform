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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="auth__header">
        <div class="container">
            SIGNUP
        </div>
    </nav>
    <main>
        <div class="signup">
            <div class="content">
                <div class="container">
                    <div class="content-body">
                    
                    <form action="../functions/form/reg.php" method="POST">
                            <label for="name">
                            Name    <input 
                            id="name" 
                            <?php validationErrorAttr('name'); ?>
                            type="text" 
                            name="name" 
                            value="<?php echo old('name') ?>" 
                            placeholder="John">
                            <?php if(hasValidationError('name')): ?>
                                <small><?php validationErrorMessage('name'); ?></small>
                            <?php endif;?>

                            </label>
                            <label for="surname">
                            Surname    <input 
                            id="surname" 
                            <?php validationErrorAttr('surname'); ?> 
                            type="text" 
                            name="surname" 
                            placeholder="Smith" 
                            value="<?php echo old('surname') ?>" >
                            <?php if(hasValidationError('surname')): ?>
                                    <small><?php validationErrorMessage('surname'); ?></small>
                                <?php endif;?>
                            </label>
                            <label for="email">Email
                                <input id="email" 
                                type="text" <?php validationErrorAttr('email'); ?>  
                                name="email" 
                                placeholder="jonh.smith@mail.com"
                                value="<?php echo old('email') ?>">
                                <?php if(hasValidationError('email')): ?>
                                    <small><?php validationErrorMessage('email'); ?></small>
                                <?php endif;?>
                            </label>
                            <label for="password">
                            <p>Password</p>
                            <input type="text" <?php validationErrorAttr('password'); ?>  name="password" placeholder="password" id="password">
                                <?php if(hasValidationError('password')): ?>
                                        <small><?php validationErrorMessage('password'); ?></small>
                                    <?php endif;?>
                            </label>
                            <p>Repeat password</p>
                            <label for="repeatedPassword">
                            <input type="text" <?php validationErrorAttr('emptypassword'); ?>  name="repeatedPassword" placeholder="repeatedPassword" id="repeatedPassword">
                                <?php if(hasValidationError('emptypassword')): ?>
                                        <small><?php validationErrorMessage('emptypassword'); ?></small>
                                    <?php endif;?>
                            </label>
                            <button type="submit">SignUp</button>
                            <?php clearValidation(); ?>
                        </form>
                        <div class="welcome-text">
                            <h1>Welcome Back!</h1>
                            <p>To keep connected with us please login with your personal info</p>
                            <a href="/EducationPlatform/auth/login.php">LogIn</a>
                            or
                            <a href="/EducationPlatform">Back to main page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
    <?php require_once '../templates/footer.php'; ?>
</body>
</html>
