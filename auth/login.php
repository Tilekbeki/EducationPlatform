<?php session_start(); 

require_once '../functions/form/helper.php';

checkGuest();
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
<h2>SignIn</h2>
<form action="../functions/form/log.php" method="POST">
    <?php if(hasMessage('error')): ?>
        <div class="notice error">
            <?php echo getMessage('error') ?>
        </div>
    <?php endif; ?>
    <label for="email">Email
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
        <input type="text" <?php validationErrorAttr('password'); ?>  name="password" placeholder="password" id="password">
            <?php if(hasValidationError('password')): ?>
                    <small><?php validationErrorMessage('password'); ?></small>
                <?php endif;?>
        </label>
    <button type="submit">SignIn</button>
</form>

</body>
</html>
