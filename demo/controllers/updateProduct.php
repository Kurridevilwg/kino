<?
include '../models/adminFunctions.php';
$id = $_GET['id'];
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$price = htmlspecialchars($_POST['price']);
$count = htmlspecialchars($_POST['count']);

$getProduct = $adminFunctions -> getProduct($id);
// var_dump($getProduct);
if(empty($_FILES['img']['name'])){
    $img = $getProduct['img'];
} else {
    unlink('../assets/img/products/' . $getProduct['img']);
    $img = uniqid() . $_FILES['img']['name'];
}
$adminFunctions -> updateProduct($id, $title, $description, $price, $count, $img);
header('Location: ../admin/admin_panel.php');