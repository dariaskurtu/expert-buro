<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прайс-лист | Независимая экспертиза</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .price-page {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .price-card {
            background: white;
            border-radius: 32px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #eef2ff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(0,0,0,0.02);
        }
        .price-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1);
            border-color: #cbd5e1;
        }
        .price-card h2 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: #1e293b;
            border-left: 5px solid #2563eb;
            padding-left: 18px;
        }
        .doc-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #f1f5f9;
            padding: 14px 28px;
            border-radius: 60px;
            text-decoration: none;
            color: #1e293b;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 1rem;
        }
        .doc-link i {
            font-size: 1.3rem;
            color: #2563eb;
        }
        .doc-link:hover {
            background: #2563eb;
            color: white;
        }
        .doc-link:hover i {
            color: white;
        }
        .note-text {
            text-align: center;
            margin-top: 40px;
            padding: 16px;
            background: #eef2ff;
            border-radius: 60px;
            font-size: 0.85rem;
            color: #475569;
        }
        @media (max-width: 640px) {
            .price-card { padding: 24px; }
            .price-card h2 { font-size: 1.2rem; }
            .doc-link { padding: 10px 20px; font-size: 0.9rem; }
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="cabinet.php">Личный кабинет</a></li>
                <?php if ($_SESSION['is_admin']): ?><li><a href="admin.php">Админ-панель</a></li><?php endif; ?>
                <li><a href="logout.php" style="color:#ef4444;">Выйти</a></li>
            <?php else: ?>
                <li><a href="#" id="authBtn" class="login-btn">Войти</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<main class="container">
    <div class="price-page">
        <!-- Пункт 1 -->
        <div class="price-card">
            <h2><i class="fas fa-file-alt"></i> Прайс-лист на оказание досудебной независимой экспертизы после ДТП</h2>
            <a href="uploads/price1.jpg" class="doc-link" target="_blank">
                <i class="fas fa-file-image"></i> Открыть документ с ценами
            </a>
        </div>

        <!-- Пункт 2 -->
        <div class="price-card">
            <h2><i class="fas fa-gavel"></i> Прайс-лист на оказание судебной экспертизы</h2>
            <a href="uploads/price2.jpg" class="doc-link" target="_blank">
                <i class="fas fa-file-image"></i> Открыть документ с ценами
            </a>
        </div>

        <!-- Пункт 3 -->
        <div class="price-card">
            <h2><i class="fas fa-chart-line"></i> Прайс-лист на оказание оценочных услуг</h2>
            <a href="uploads/price3.pdf" class="doc-link" target="_blank">
                <i class="fas fa-file-image"></i> Открыть документ с ценами
            </a>
        </div>

        <div class="note-text">
            <i class="fas fa-info-circle"></i> Все документы заверены печатью организации. Для получения актуальных цен скачайте или откройте файлы выше.
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

<!-- Модальное окно -->
<div id="authModal" class="modal"><div class="modal-content"><span class="close-modal" id="closeModal">&times;</span>
<div id="loginForm"><h3>Вход</h3><form method="POST" action="auth.php"><input type="hidden" name="action" value="login"><input type="text" name="phone" placeholder="Телефон" required><input type="password" name="password" placeholder="Пароль" required><button type="submit">Войти</button></form><div class="switch-form"><a id="showRegister">Зарегистрироваться</a></div></div>
<div id="registerForm" style="display:none;"><h3>Регистрация</h3><form method="POST" action="auth.php"><input type="hidden" name="action" value="register"><input type="text" name="name" placeholder="Ваше имя" required><input type="text" name="phone" placeholder="Телефон" required><input type="password" name="password" placeholder="Пароль" required><button type="submit">Зарегистрироваться</button></form><div class="switch-form"><a id="showLogin">Войти</a></div></div>
</div></div>

<script src="script.js"></script>
</body>
</html>