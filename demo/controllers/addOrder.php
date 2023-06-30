<?
include "../models/authentication.php";
include "../models/shop.php";

$products = $_SESSION['cart'];
$payment = htmlspecialchars($_POST['payment']);
$address = htmlspecialchars($_POST['address']);
$password = htmlspecialchars($_POST['check_password']);
$id = $user['id'];
$error = '';
$checkPassword = $auth -> comparePasswords($id, $password);

if (!$user) {
    $error = 'Чтобы заказать вам нужно авторизоваться!';
} else if(empty($products)){
    $error = 'Корзина пустая!';
} else if($address == ""){
    $error = 'Заполните поле с адрессом';
} else if(!$checkPassword){
    $error = 'Неверный пароль';
}

if($error !== ''){
    echo $error;
    http_response_code(400);
    die();
}

$order_number = uniqid();
$client = $user['id'];
$price = $_SESSION["cart.sum"];
$date = time();

order($order_number, $client, $price, $date, $payment, $address);

foreach($products as $key => $product){
    $id_product = $key;
    $title = $product['title'];
    $qty = $product['qty'];
    $price_product = $product['price'];
    $img = $product['img'];
    $qty_reduction = getCountProduct($id_product);
    $qty_reduction = $qty_reduction['count'] - $qty;
    order_list($order_number, $id_product, $title, $qty, $price_product, $img);
    reductionProduct($id_product, $qty_reduction);
}
