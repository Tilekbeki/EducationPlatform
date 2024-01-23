<?php

function redirect(string $path) {
    header("Location: $path");
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
    if(!isset($_SESSION['user']['id']) || !isset($_COOKIE['user'])) {
        redirect('/');
    }
}


function checkGuest() {
    if(isset($_SESSION['user']['id']) || isset($_COOKIE['user'])) {
        redirect('/');
    }
}
?>