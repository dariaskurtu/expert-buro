<?php require_once 'config.php'; if (!isset($_SESSION['user_id'])) header('Location: index.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar"><div class="container nav-container"><div class="logo">Независимые<span>Эксперты</span></div><button class="hamburger" id="hamburgerBtn">☰</button>
<ul class="nav-links" id="navLinks"><li><a href="index.php">Главная</a></li><li><a href="about.php">О компании</a></li><li><a href="price.php">Прайс лист</a></li><li><a href="map.php">Схема проезда</a></li><li><a href="tech.php">Технологии и термины</a></li><li><a href="cabinet.php">Личный кабинет</a></li><?php if ($_SESSION['is_admin']): ?><li><a href="admin.php">Админ-панель</a></li><?php endif; ?><li><a href="logout.php" style="color:#ef4444;">Выйти</a></li></ul></div></nav>

<main class="container">
    <div class="page-section">
        <h2>Личный кабинет</h2>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <span>Здравствуйте, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></span>
        </div>
        <h3>Мои заявки</h3>
        <div class="applications-list">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM applications WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$_SESSION['user_id']]);
            $apps = $stmt->fetchAll();
            if (count($apps) === 0) echo '<p>У вас пока нет заявок. Оставьте заявку на главной странице.</p>';
            foreach ($apps as $app):
                $statusClass = '';
                if ($app['status'] == 'new') $statusClass = 'status-new';
                elseif ($app['status'] == 'expert') $statusClass = 'status-expert';
                elseif ($app['status'] == 'inspection') $statusClass = 'status-inspection';
                else $statusClass = 'status-ready';
            ?>
            <div class="application-card">
                <div class="app-number">Заявка №<?= $app['id'] ?></div>
                <div class="app-type"><?= htmlspecialchars($app['expertise_type']) ?></div>
                <div>Авто: <?= htmlspecialchars($app['car_brand'] ?? '—') ?> <?= htmlspecialchars($app['car_model'] ?? '') ?></div>
                <div>Дата: <?= date('d.m.Y', strtotime($app['created_at'])) ?></div>
                <div class="status <?= $statusClass ?>"><?= htmlspecialchars($app['status_text']) ?></div>
                <?php if ($app['report_url']): ?>
                    <a href="<?= $app['report_url'] ?>" class="download-link" target="_blank">Скачать отчет</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<footer><div class="container footer-inner"><div>© 2025 Независимые эксперты</div><div><i class="fas fa-phone-alt"></i> +7 (495) 123-45-67</div></div></footer>
<script src="script.js"></script>
</body>
</html>