<?php
include_once 'connection.php';
$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);
$user = $auth->getCurrentUser();
class Authentication{
    private $pdo;
    private $hash='kyuytjfnfgd5yh433f';

    public function __construct($pdo){
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function findUser($login) {
        $sql = 'SELECT id, login, email, rights FROM demo.users WHERE login = :login LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function infoUser($id){
        $sql = 'SELECT id, login, email, profile_img, rights FROM demo.users WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function allUser() {
        $sql = 'SELECT * FROM tea.users ORDER BY id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comparePasswords($id, $oldPassword) {
        $sql = 'SELECT id, password FROM demo.users WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPassword = md5($oldPassword . $this->hash);
            if ($user['password'] !== $oldPassword) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function register($login, $email, $name, $surname, $patronymic, $password) {
        $findUser = $this->findUser($login);
        $password = md5($password . $this->hash);
        if ($findUser === false){
            $sql = 'INSERT INTO demo.users (login, email, password, name, surname, patronymic, rights) VALUES (:login, :email, :password, :name, :surname, :patronymic, 0)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':surname', $surname);
            $stmt->bindValue(':patronymic', $patronymic);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            http_response_code(200);
            $_SESSION['user'] = $login;
            return true;
        }
        http_response_code(400);
        echo 'Такой пользователь уже есть!';
    }

    public function login($login, $password) {
        $findUser = $this->findUser($login);
        $password = md5($password . $this->hash);
        if ($findUser !== null){
            $sql = 'SELECT * FROM tea.users WHERE login = :login AND password = :password LIMIT 1';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_count = $stmt->rowCount();
            if($row_count === 1) {
                http_response_code(200);
                $_SESSION['user'] = $user['login'];
                return true;
            } else {
                http_response_code(400);
                echo 'Неправильная почта / пароль';
                exit();
            }
        }
        echo'Такого пользователя нету';
    }

    // Редактирование пользователя админом
    public function admin_edit($email, $img, $rights) {
        $findUser = $this->findUser($email);
        if ($findUser !== false){
            move_uploaded_file($_FILES['useravatar']['tmp_name'], '../assets/img/users/' . $img);
            $sql = 'UPDATE tea.users SET profile_img = :img, rights = :rights WHERE email = :email';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':img', $img);
            $stmt->bindValue(':rights', $rights);
            $stmt->execute();
            return true;
        }
        return false;
    }
    // Редактивароние самим пользователем
    public function updateProfile($id, $login, $profile_img) {
        $findUser = $this->infoUser($id);
        if(!empty($_FILES['file']['name'])){
            move_uploaded_file($_FILES['file']['tmp_name'], '../assets/img/users/' . $profile_img);
        }
        if ($findUser !== false){
            $sql = 'UPDATE tea.users SET login = :login, profile_img = :profile_img WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':profile_img', $profile_img);
            $stmt->execute();
            return true;
        }
        return false;
    }
    // Изменение пароля
    public function password_edit($id, $password) {
        $findUser = $this->infoUser($id);
        $password = md5($password . $this->hash);
        if ($findUser !== false){
            $sql = 'UPDATE tea.users SET password = :password WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            return true;
        }
        return false;
    }
    // Удаление пользователя
    public function delete(string $id) {
        $sql = 'DELETE FROM tea.reviews WHERE reviewer = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $sql = 'DELETE FROM public.users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    }
    public function logout() {
        unset($_SESSION['user']);
    }

    public function isAuthed() {
        if (array_key_exists('user', $_SESSION) && $_SESSION['user'] !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser() {
        if ($this->isAuthed()) {
            return $this->findUser($_SESSION['user']);
        }
        return false;
    }
}
