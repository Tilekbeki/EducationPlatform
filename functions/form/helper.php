<?php
use \Firebase\JWT\JWT; // Добавление подключения к классу JWT
use \Firebase\JWT\Key;
function redirect(string $path) {
    header("Location: $path");
}
function dbConnection() {
    $db = @mysqli_connect('localhost', 'root', '' , 'onlinePlatform') or die('ошибка подключения к бд');
    mysqli_set_charset($db,'utf8') or die('неправильная кодировка');//установили кодировку
    return $db;
}
function addValidationError(string $fieldName, string $message) {
    $_SESSION['validation'][$fieldName] = $message;
}

function clearValidation() {
    $_SESSION['validation'] = [];
}

//показывает есть ли ошибка или нет
function hasValidationError(string $fieldName):bool { 
    return isset($_SESSION['validation'][$fieldName]);
}
//ставит атрибут для красной рамки инпута если есть ошибка в сессии
function validationErrorAttr(string $fieldName) {
    echo isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}
//показывает в html сообщение что есть ошибка
function validationErrorMessage(string $fieldName) {
    $message = $_SESSION['validation'][$fieldName] ?? '';//проверяет есть ли такое поле потом показывает значение ошибки если есть
    unset($_SESSION['validation'][$fieldName]);
    echo $message;
}
//добавления в сесссию
function addOldValue(string $key, mixed $value):void {
    $_SESSION['old'][$key] = $value;
}

function old($key) {
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function clearOldValues(string $key):void {
    $_SESSION['old'] = [];
}


//login

function setMessage(string $key, string $message):void {
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key):bool {
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string {
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}
function checkAuth() {
    if(!isset($_COOKIE['token'])) {
        redirect('/EducationPlatform');
    } else {
        $_SESSION['token']['value'] = $_COOKIE['token'];
    }
}


function checkGuest() {
    if(isset($_SESSION['token']['value']) || isset($_COOKIE['token'])) {
        redirect('/EducationPlatform');
    }
}

function giveInfoByToken(string $token): array {
    $token = $_COOKIE['token'];
    $key = "your_secret_key";
    
    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        
        // Добавляем подключение к базе данных
        $db = dbConnection();

        // Получаем user_id из декодированного токена
        $user_id = $decoded->user_id;

        // Выполняем запрос к базе данных
        $select = "SELECT topic.name, topic.course FROM topic JOIN usertopic ON topic.name = usertopic.topic WHERE usertopic.id_user = $user_id";
        $query1 = mysqli_query($db, $select);
        $topics = mysqli_fetch_all($query1, MYSQLI_ASSOC);

        mysqli_close($db); // Закрываем соединение с базой данных

        return [
            'user_id' => $decoded->user_id,
            'username' => $decoded->username,
            'usersurname' => $decoded->usersurname,
            'email' => $decoded->email,
            'password' => $decoded->password,
            'topics' => $topics // Добавляем полученные темы в массив
        ];
    } catch (\Firebase\JWT\SignatureInvalidException $e) {
        echo 'Подпись токена недействительна.';
    } catch (\Firebase\JWT\BeforeValidException $e) {
        echo 'Токен еще не действителен.';
    } catch (\Firebase\JWT\ExpiredException $e) {
        echo 'Токен истек.';
    } catch (\Exception $e) {
        echo 'Ошибка при декодировании токена: ' . $e->getMessage();
    }
}
?>