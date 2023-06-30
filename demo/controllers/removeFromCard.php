<?php
session_start();
include_once '../models/shop.php';
$id = $_GET['id'];

if (isset($id)) {
    switch ($_GET['remove']) {
        case 'all':
            echo json_encode(['code' => 'all', 'answer' => removeAllFromCard($id, $_GET['count']), 'qty' => $_SESSION['cart.qty']]);
            break;
        case 'one':
            removeFromCard($id);
            echo json_encode(['code' => 'one', 'answer' => $id, 'qty' => $_SESSION['cart.qty']]);
            break;
    }
} else {
    echo json_encode(['code' => 'error', 'answer' => 'Error remove from card']);
}