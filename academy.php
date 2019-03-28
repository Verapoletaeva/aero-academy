<?php
require_once 'connection.php';
session_start();
$_SESSION['errors'] = "";
$errors = "";

//обработка капчи
$secretKey = "6LewZ5oUAAAAABr_l8QYF1aLMyZRWshc55cDmIl4";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);
if(!($response->success)) {
    $errors = $errors."0";
}

//ф-ия преобразования вводимых данных
function clean($value = '') {
    $value = trim($value);
    $value = addslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}


$full_name = clean($_POST['full_name']);
$phone_number = clean($_POST['phone_number']);
$email = clean($_POST['email']);
$birthday = $_POST['birthday'];
$comment = clean($_POST['comment']);

//ф-ия проверки длины
function check_length($value = '', $min, $max) {
    $result = (mb_strlen($value, 'UTF-8') >= $min && mb_strlen($value, 'UTF-8') <= $max);

    return $result;
}

//ф-ия проверки телефона
function phone_number($value = '') {
    if(preg_match('/^[+]?[7]([\d]{10})$/', $value))
        $result = true;
    else
        $result = false;

    return $result;
}

//проверка имени
if(!check_length($full_name, 6, 20)) {
    $errors = $errors."1";
}
//проверка номера телефона
if(!phone_number($phone_number)) {
    $errors = $errors."2";
}

//проверка почты
if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !check_length($full_name, 6, 20))  {
    $errors = $errors."3";
}

//проверка даты
$birthday_arr = explode('-', $birthday);
if(!checkdate($birthday_arr[1], $birthday_arr[2], $birthday_arr[0]) || $birthday < '1920-01-01' || $birthday > date('Y-m-d')){
    $errors = $errors."4";
}

//проверка длины коммента (>= 10)
if(mb_strlen($comment) < 10) {
    $errors = $errors."5";
}


//работа с бд
if ($errors == "") {
    $link = mysqli_connect($host, $user, $password, $database)
    or $errors = $errors . "6";

    mysqli_query($link, "SET NAMES 'utf8'");

    $query = "INSERT INTO academy (`name`, `phone_number`, `email`, `birthday`, `comment`) 
        VALUES ('$full_name','$phone_number','$email','$birthday','$comment')";

    $result = mysqli_query($link, $query)
    or $errors = $errors . "7";

    mysqli_close($link);
}

//ошибки
if ($errors == "")
    $errors = "ok";

$_SESSION['errors'] = $errors;

header("Location: /");


