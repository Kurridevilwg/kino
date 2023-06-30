<?
include '../models/adminFunctions.php';
$id = $_GET['id'];
$adminFunctions -> deleteProduct($id);

header('Location: ../admin/admin_panel.php');