<?php session_start(); 
require_once '../functions/form/helper.php';
checkGuest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
    
    <h2>Регистрация</h2>
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
        <input type="text" <?php validationErrorAttr('password'); ?>  name="password" placeholder="password" id="password">
            <?php if(hasValidationError('password')): ?>
                    <small><?php validationErrorMessage('password'); ?></small>
                <?php endif;?>
        </label>
        <label for="repeatedPassword">
        <input type="text" <?php validationErrorAttr('emptypassword'); ?>  name="repeatedPassword" placeholder="repeatedPassword" id="repeatedPassword">
            <?php if(hasValidationError('emptypassword')): ?>
                    <small><?php validationErrorMessage('emptypassword'); ?></small>
                <?php endif;?>
        </label>
        <button type="submit">SignUp</button>
        <?php clearValidation(); ?>
    </form>
</body>
</html>
