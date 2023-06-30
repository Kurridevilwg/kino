<?php
include_once '../models/authentication.php';

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

$auth->login($login, $password);