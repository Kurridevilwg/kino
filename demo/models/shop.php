<?php
include_once 'connection.php';


function order($order_number, $client, $price, $date, $payment, $address)
{
    $pdo = Connection::get()->connect();
    $sql = 'INSERT INTO demo.orders (order_number, id_user, price_order, date, status, address, payment_method) VALUES (:order_number, :id_user, :price_order, :date, :status, :address, :payment_method)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':order_number', $order_number);
    $stmt->bindValue(':id_user', $client);
    $stmt->bindValue(':price_order', $price);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':status', 0);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':payment_method', $payment);
    $stmt->execute();
    return true;
}

function order_list($order_number, $id_product, $name_product, $qty, $price_product, $img)
{
    $pdo = Connection::get()->connect();
    $sql = 'INSERT INTO demo.order_list (order_number, name_product, qty, price_product, img, id_product) VALUES (:order_number, :name_product, :qty, :price_product, :img, :id_product)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_product', $id_product);
    $stmt->bindValue(':order_number', $order_number);
    $stmt->bindValue(':name_product', $name_product);
    $stmt->bindValue(':qty', $qty);
    $stmt->bindValue(':price_product', $price_product);
    $stmt->bindValue(':img', $img);
    $stmt->execute();
    return true;
}
// Уменьшение количества товаров
function reductionProduct($id_product, $qty)
{
    $pdo = Connection::get()->connect();
    $sql = 'UPDATE demo.products SET count = :count WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id_product);
    $stmt->bindValue(':count', $qty);
    $stmt->execute();
    return true;
}
function getCountProduct($id_product){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT count FROM demo.products WHERE id = :id_product';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id_product', $id_product);
    $statement->execute();
    $products = $statement->fetch(PDO::FETCH_ASSOC);
    return $products;
}
function removeAllFromCard($id, $count)
{
    if ($_SESSION['cart.qty'] === 0) return; // проверка, если товаров нет в корзине
    unset($_SESSION['cart'][$id]);
    $product = getProduct($id);
    $productPrice = $product['price'];
    $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $productPrice * $count;
    $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - $count;
}

function removeFromCard($id)
{
    $_SESSION['cart.qty'] = --$_SESSION['cart.qty'];
    $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$id]['price'];

    if ($_SESSION['cart'][$id]['qty'] === 1) {
        unset($_SESSION['cart'][$id]);
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] -= 1;
    }
}

function addFromCard($id)
{
    $_SESSION['cart.qty'] = ++$_SESSION['cart.qty'];
    $_SESSION['cart.sum'] = $_SESSION['cart.sum'] + $_SESSION['cart'][$id]['price'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    }
}

// Добавление в корзину
function addToCard($product)
{
    if (isset($_SESSION['cart'][$product['id']])) {
        $_SESSION['cart'][$product['id']]['qty'] += 1;
    } else {
        $_SESSION['cart'][$product['id']] = [
            'title' => $product['title'],
            'price' => $product['price'],
            'img' => $product['img'],
            'qty' => 1,
        ];
    }
    $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? ++$_SESSION['cart.qty'] : 1;
    $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product['price'] : $product['price'];
}

// Информация Чая по id
function getProduct($id)
{
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM demo.products WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', intval($id));
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProducts()
{
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM tea.products';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
// Заказы у пользователя
function getOrders($id_user){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM demo.orders WHERE id_user = :id_user';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id_user', $id_user);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
// Заказ по номеру
function getNumberOrder($order_number){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM demo.orders WHERE order_number = :order_number LIMIT 1';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':order_number', $order_number);
    $statement->execute();
    $products = $statement->fetch(PDO::FETCH_ASSOC);
    return $products;
}
// Подробности заказа
function getOrderList($order_number){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM demo.order_list WHERE order_number = :order_number';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':order_number', $order_number);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
// Принять заявку
function acceptOrder($id){
    $pdo = Connection::get()->connect();
    $sql = 'UPDATE tea.orders SET status = 1 WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    return true;
}
// Отклонить заявку
function rejectOrder($id){
    $pdo = Connection::get()->connect();
    $sql = 'UPDATE tea.orders SET status = 2 WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    return true;
}
// Все заявки пользователей
function allOrders(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT order_number, login, date FROM tea.orders LEFT JOIN tea.users ON tea.orders.id_user=tea.users.id ORDER BY date DESC';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
