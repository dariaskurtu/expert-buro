<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'register') {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        
        if (empty($name) || empty($phone) || empty($password)) {
            header('Location: index.php?error=Заполните все поля');
            exit;
        }
        
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, phone, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $phone, $hashed]);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            $_SESSION['is_admin'] = 0;
            header('Location: cabinet.php');
        } catch (PDOException $e) {
            header('Location: index.php?error=Телефон уже зарегистрирован');
        }
        exit;
    }
    
    if ($action === 'login') {
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header('Location: cabinet.php');
        } else {
            header('Location: index.php?error=Неверный телефон или пароль');
        }
        exit;
    }
}
?>