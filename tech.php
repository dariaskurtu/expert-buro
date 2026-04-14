<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Технологии и термины кузовного ремонта</title>
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
        <h2><i class="fas fa-car-battery"></i> Технологии и термины кузовного ремонта</h2>
        <p>Современный кузовной ремонт требует знания материалов и технологий. Наши эксперты владеют инновационными методами диагностики.</p>
        <div class="terms-grid">
            <div class="term-card"><h4><i class="fas fa-wrench"></i> Рихтовка</h4><p>Восстановление геометрии кузова без замены деталей, методом вытяжки и правки.</p></div>
            <div class="term-card"><h4><i class="fas fa-ruler"></i> 3D-замер геометрии</h4><p>Лазерное сканирование кузова для выявления перекосов и деформаций силовой структуры.</p></div>
            <div class="term-card"><h4><i class="fas fa-fill-drip"></i> Кислотный грунт</h4><p>Антикоррозийное покрытие, наносимое на голый металл перед шпатлеванием.</p></div>
            <div class="term-card"><h4><i class="fas fa-paint-roller"></i> Полиэфирная шпатлевка</h4><p>Материал для выравнивания поверхностей перед покраской.</p></div>
            <div class="term-card"><h4><i class="fas fa-palette"></i> Окраска по переходу</h4><p>Технология частичного окрашивания элемента с незаметным переходом цвета.</p></div>
            <div class="term-card"><h4><i class="fas fa-sun"></i> Инфракрасная сушка</h4><p>Ускоренная полимеризация ЛКМ с помощью ИК-излучателей.</p></div>
        </div>
        <div class="contact-block" style="margin-top:32px;">
            <i class="fas fa-microchip"></i> <strong>Современное оборудование:</strong> стапель Car-O-Liner, спектрофотометр для подбора краски, лазерный замер кузова.
        </div>
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