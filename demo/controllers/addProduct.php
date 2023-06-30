<?
include '../models/adminFunctions.php';

$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$price = htmlspecialchars($_POST['price']);
$count = htmlspecialchars($_POST['count']);

$img = uniqid() . $_FILES['img']['name'];

$adminFunctions -> addProduct($title, $description, $price, $count, $img);