<?php
session_start();
include_once '../models/shop.php';
$id = $_GET['id'];
$product = getProduct($id);
$res = $product['count'] - $_SESSION['cart'][$id]['qty'];

if (isset($id) && $res > 0) {
    addFromCard($id);
    echo json_encode(['code' => 'ok', "res" => $res, 'answer' => $id, 'qty' => $_SESSION['cart.qty']]);
} else {
    echo json_encode(['code' => 'error', 'count' => $product['count'], 'answer' => 'Error remove from card']);
}
