<?php
session_start();
include_once '../models/shop.php';
$id = $_GET['id'];

$id = isset($id) ? (int)$id : 0;

$product = getProduct($id);
$res = $product['count'] - $_SESSION['cart'][$id]['qty'];

if ($product && $res > 0) {
    addToCard($product);
    echo json_encode(['code' => 'ok', 'answer' => $product, 'qty' => $_SESSION['cart.qty']]);
} else {
    echo json_encode(['code' => 'error', 'answer' => 'Error product', 'count' => $product['count']]);
}
