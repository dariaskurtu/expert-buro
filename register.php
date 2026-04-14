<?php 
require_once 'config.php'; 

// Если пользователь уже авторизован, перенаправляем в личный кабинет
if (isset($_SESSION['user_id'])) {
    header('Location: cabinet.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($name) || empty($phone) || empty($password)) {
        $error = 'Заполните все поля';
    } elseif ($password !== $confirm_password) {
        $error = 'Пароли не совпадают';
    } elseif (strlen($password) < 4) {
        $error = 'Пароль должен быть не менее 4 символов';
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, phone, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $phone, $hashed]);
            $success = 'Регистрация успешна! Теперь вы можете войти.';
            $name = '';
            $phone = '';
        } catch (PDOException $e) {
            $error = 'Телефон уже зарегистрирован';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация | Независимая экспертиза</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .register-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 0 20px;
        }
        .register-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
            border: 1px solid #eef2ff;
        }
        .register-card h1 {
            font-size: 1.8rem;
            margin-bottom: 8px;
            text-align: center;
        }
        .register-card .subtitle {
            text-align: center;
            color: #475569;
            margin-bottom: 30px;
        }
        .register-card input {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 60px;
            font-size: 1rem;
            transition: all 0.2s;
        }
        .register-card input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }
        .register-card button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 60px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .register-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(16,185,129,0.4);
        }
        .error-msg {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }
        .success-msg {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }
        .login-link {
            text-align: center;
            margin-top: 24px;
            color: #475569;
        }
        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .back-home {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }
        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container nav-container">
        <div class="logo">Независимые<span>Эксперты</span></div>
        <button class="hamburger" id="hamburgerBtn">☰</button>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Главная</a></li>
            <li><a href="about.php">О компании</a></li>
            <li><a href="price.php">Прайс лист</a></li>
            <li><a href="map.php">Схема проезда</a></li>
            <li><a href="tech.php">Технологии и термины</a></li>
            <li><a href="register.php" class="login-btn" style="background:#10b981;">Регистрация</a></li>
            <li><a href="#" id="authBtn" class="login-btn">Войти</a></li>
        </ul>
    </div>
</nav>

<main>
    <div class="register-container">
        <a href="index.php" class="back-home"><i class="fas fa-arrow-left"></i> На главную</a>
        <div class="register-card">
            <h1><i class="fas fa-user-plus"></i> Регистрация</h1>
            <div class="subtitle">Создайте аккаунт, чтобы оставлять заявки и отслеживать их статус</div>
            
            <?php if ($error): ?>
                <div class="error-msg"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success-msg"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Ваше имя" value="<?= htmlspecialchars($name ?? '') ?>" required>
                <input type="tel" name="phone" placeholder="Телефон (например, +7 999 123-45-67)" value="<?= htmlspecialchars($phone ?? '') ?>" required>
                <input type="password" name="password" placeholder="Пароль (не менее 4 символов)" required>
                <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required>
                <button type="submit"><i class="fas fa-check"></i> Зарегистрироваться</button>
            </form>
            
            <div class="login-link">
                Уже есть аккаунт? <a href="#" id="loginLink">Войти</a>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container footer-inner">
        <div>© 2025 Независимые эксперты — честные заключения</div>
        <div><i class="fas fa-phone-alt"></i> +7 (495) 123-45-67</div>
        <div><i class="fas fa-envelope"></i> info@expert.pro</div>
    </div>
</footer>

<!-- Модальное окно входа -->
<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" id="closeModal">&times;</span>
        <div id="loginForm">
            <h3>Вход в личный кабинет</h3>
            <form method="POST" action="auth.php">
                <input type="hidden" name="action" value="login">
                <input type="text" name="phone" placeholder="Телефон" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>
            <div class="switch-form">
                <a href="register.php">Нет аккаунта? Зарегистрироваться</a>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<script>
    // Модальное окно
    const modal = document.getElementById('authModal');
    const closeModal = document.getElementById('closeModal');
    const authBtn = document.getElementById('authBtn');
    const loginLink = document.getElementById('loginLink');
    
    if (authBtn) {
        authBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
        });
    }
    
    if (loginLink) {
        loginLink.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
        });
    }
    
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    }
    
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
</script>
</body>
</html>