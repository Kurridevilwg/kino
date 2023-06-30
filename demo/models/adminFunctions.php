<?php
include_once 'connection.php';

$pdo = Connection::get()->connect();
$adminFunctions = new AdminFunctions($pdo);

class AdminFunctions
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    function addProduct($title, $description, $price, $count, $img)
    {
        move_uploaded_file($_FILES['img']['tmp_name'], '../assets/img/products/' . $img);
        $sql = 'INSERT INTO demo.products (title, description, price, count, img) VALUES (:title, :description, :price, :count, :img)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':count', $count);
        $stmt->bindValue(':img', $img);
        $stmt->execute();
        http_response_code(200);
        return true;
    }
    function updateProduct($id, $title, $description, $price, $count, $img)
    {
        move_uploaded_file($_FILES['img']['tmp_name'], '../assets/img/products/' . $img);
        $sql = 'UPDATE demo.products SET title = :title, description = :description, price = :price, count = :count, img = :img WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':count', $count);
        $stmt->bindValue(':img', $img);
        $stmt->execute();
        http_response_code(200);
        return true;
    }
    public function allProducts()
    {
        $sql = 'SELECT * FROM demo.products ORDER BY id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProduct($id)
    {
        $sql = 'SELECT * FROM demo.products WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteProduct($id)
    {
        $sql = 'DELETE FROM demo.products WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    }
}
