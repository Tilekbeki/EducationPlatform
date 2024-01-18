<?php 
$db = @mysqli_connect('localhost', 'root', '' , 'onlinePlatform') or die('ошибка подключения к бд');
mysqli_set_charset($db,'utf8') or die('неправильная кодировка');//установили кодировку