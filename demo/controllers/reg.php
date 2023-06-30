<?php
include '../models/authentication.php';

$login = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);;
$surname = htmlspecialchars($_POST['surname']);;
$patronymic = htmlspecialchars($_POST['patronymic']);;
$password = htmlspecialchars($_POST['password']);
$passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);
$findUser = $auth -> findUser($email);
$error = '';

if (mb_strlen($login) <= 3 || mb_strlen($login) > 20) {
    $error = "Недопустимая длина логина (от 3 до 20)";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Почта неправильно написана";
} else if (mb_strlen($name) < 3 || mb_strlen($name) > 20) {
    $error = "Недопустимая длина имени (от 3 до 20)";
} else if (mb_strlen($surname) <= 5 || mb_strlen($surname) > 20) {
    $error = "Недопустимая длина фамилии (от 5 до 20)";
} else if (mb_strlen($patronymic) <= 5 || mb_strlen($patronymic) > 20) {
    $error = "Недопустимая длина отчества (от 5 до 20)";
} else if ($password != $passwordConfirm) {
    $error = "Пароли не сходятся";
} else if (!empty($findUser)) {
    $error = 'Такой пользователь уже есть';
};
if ($error != '') {
    http_response_code(400);
    echo $error;
    exit();
};

$userId = $auth->register($login, $email, $name, $surname, $patronymic, $password);