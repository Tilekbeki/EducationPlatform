<?php 
require_once('../functions/db.php');
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output
$site = 'http://localhost/EducationPlatform';
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'tilekshannel@gmail.com';                 // Наш логин
$mail->Password = 'ieji tmnh qtgn tjut';                           // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted ieji tmnh qtgn tjut

$mail->Port = 465;                                   // TCP port to connect to
 
$mail->setFrom('tilekshannel@gmail.com', 'EducationPlatform');


$email = $_POST['email'];

$select = "SELECT * FROM `user` WHERE email = '$email'";
$query1 = mysqli_query($db,$select);
$user = mysqli_fetch_assoc($query1);
if ($user) {
	// $mail->addAddress('timur.almamatov@yandex.ru');     // Add a recipient
$mail->addAddress($email);     // Add a recipient
$reset_token = hash('sha384', time().$email); //токен
$href = $site."/auth/password-reset.php?reset_token=".$reset_token."&email=".$email;
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Reset password';
$mail->Body    = '
		Hello here is a link to reset your password <br> 
		To reset your password, follow the link' . $href . ' <br>
		From: Education@mail.ru' . $email . '';

	if(!$mail->send()) {
		echo "Message could not be sent.";
		return false;
	} else {
		echo "Message sent successfully!";
		return true;
	}
} else {
	echo "This user doesn't exist";
}




?>