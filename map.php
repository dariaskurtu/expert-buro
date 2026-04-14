<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Схема проезда</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar"><div class="container nav-container"><div class="logo">Независимые<span>Эксперты</span></div><button class="hamburger" id="hamburgerBtn">☰</button>
<ul class="nav-links" id="navLinks"><li><a href="index.php">Главная</a></li><li><a href="about.php">О компании</a></li><li><a href="price.php">Прайс лист</a></li><li><a href="map.php">Схема проезда</a></li><li><a href="tech.php">Технологии и термины</a></li>
<?php if (isset($_SESSION['user_id'])): ?><li><a href="cabinet.php">Личный кабинет</a></li><?php if ($_SESSION['is_admin']): ?><li><a href="admin.php">Админ-панель</a></li><?php endif; ?><li><a href="logout.php" style="color:#ef4444;">Выйти</a></li><?php else: ?><li><a href="#" id="authBtn" class="login-btn">Войти</a></li><?php endif; ?></ul></div></nav>

<main class="container">
    <div class="page-section">
        <h2>Схема проезда</h2>
        <p>Наш офис: <strong>г. Омск, ул. Маяковского, д.64, оф.4</strong></p>
        <div class="map-frame">
            <iframe src="https://yandex.ru/map-widget/v1/?ll=73.368,54.988&z=16&pt=73.368,54.988&l=map" allowfullscreen></iframe>
        </div>
        <p><i class="fas fa-subway"></i> Остановка общественного транспорта "Маяковского" — 2 минуты пешком. Парковка для клиентов бесплатная.</p>
        <p><i class="fas fa-clock"></i> Часы работы офиса: Пн–Пт 09:00–19:00</p>
    </div>
</main>

<footer><div class="container footer-inner"><div>© 2025 Независимые эксперты</div><div><i class="fas fa-phone-alt"></i> +7 (495) 123-45-67</div></div></footer>

<div id="authModal" class="modal"><div class="modal-content"><span class="close-modal" id="closeModal">&times;</span>
<div id="loginForm"><h3>Вход</h3><form method="POST" action="auth.php"><input type="hidden" name="action" value="login"><input type="text" name="phone" placeholder="Телефон" required><input type="password" name="password" placeholder="Пароль" required><button type="submit">Войти</button></form><div class="switch-form"><a id="showRegister">Зарегистрироваться</a></div></div>
<div id="registerForm" style="display:none;"><h3>Регистрация</h3><form method="POST" action="auth.php"><input type="hidden" name="action" value="register"><input type="text" name="name" placeholder="Ваше имя" required><input type="text" name="phone" placeholder="Телефон" required><input type="password" name="password" placeholder="Пароль" required><button type="submit">Зарегистрироваться</button></form><div class="switch-form"><a id="showLogin">Войти</a></div></div>
</div></div>

<script src="script.js"></script>
</body>
</html>