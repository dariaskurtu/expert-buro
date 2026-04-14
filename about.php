<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О компании</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    <div class="container nav-container">
        <div class="logo">Независимые<span>Эксперты</span></div>
        <button class="hamburger" id="hamburgerBtn">☰</button>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Главная</a></li><li><a href="about.php">О компании</a></li><li><a href="price.php">Прайс лист</a></li><li><a href="map.php">Схема проезда</a></li><li><a href="tech.php">Технологии и термины</a></li>
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
    <div class="page-section">
        <h2>О компании</h2>
        <p><strong>Омское независимое экспертно-оценочное бюро</strong> основано в 2009 году. За время работы мы приобрели большой опыт в подготовке заключений независимой экспертизы для суда.</p>
        <p>Мы помогаем клиентам защитить свои права перед страховыми компаниями, специализируясь на досудебной и судебной экспертизе транспортных средств в Омске и области.</p>
        <h3>Цели и задачи:</h3>
        <ul><li>помощь гражданам</li><li>построение долгосрочных отношений с клиентами</li><li>совершенствование профессиональных навыков</li></ul>
        <h3>Наши эксперты</h3>
        <div class="experts-grid">
            <div class="expert-card"><div class="expert-avatar"><i class="fas fa-user-tie"></i></div><div class="expert-name">Манюков Сергей Александрович</div></div>
            <div class="expert-card"><div class="expert-avatar"><i class="fas fa-user-graduate"></i></div><div class="expert-name">Мусатов Дмитрий Александрович</div></div>
            <div class="expert-card"><div class="expert-avatar"><i class="fas fa-user-astronaut"></i></div><div class="expert-name">Рюмин Александр Владимирович</div></div>
            <div class="expert-card"><div class="expert-avatar"><i class="fas fa-user-ninja"></i></div><div class="expert-name">Нефедов Виталий Сергеевич</div></div>
            <div class="expert-card"><div class="expert-avatar"><i class="fas fa-user-check"></i></div><div class="expert-name">Елисеев Леонид Алексеевич</div></div>
        </div>
        <h3>Руководитель</h3>
        <div class="expert-card" style="max-width:300px;"><div class="expert-avatar"><i class="fas fa-briefcase"></i></div><div class="expert-name">Гребнев Дмитрий Олегович</div></div>
        <div class="contact-block">Благодарим за использование нашего сайта! Звоните: 53-47-26</div>
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