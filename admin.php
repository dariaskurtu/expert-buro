<?php 
require_once 'config.php'; 
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) header('Location: index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $status = $_POST['status'];
    $report_url = $_POST['report_url'] ?? '';
    $status_text = '';
    if ($status == 'new') $status_text = 'Новая';
    elseif ($status == 'expert') $status_text = 'Эксперт назначен';
    elseif ($status == 'inspection') $status_text = 'Осмотр проведен';
    else $status_text = 'Отчет готов';
    $stmt = $pdo->prepare("UPDATE applications SET status = ?, status_text = ?, report_url = ? WHERE id = ?");
    $stmt->execute([$status, $status_text, $report_url, $_POST['app_id']]);
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar"><div class="container nav-container"><div class="logo">Независимые<span>Эксперты</span></div><button class="hamburger" id="hamburgerBtn">☰</button>
<ul class="nav-links" id="navLinks"><li><a href="index.php">Главная</a></li><li><a href="about.php">О компании</a></li><li><a href="price.php">Прайс лист</a></li><li><a href="map.php">Схема проезда</a></li><li><a href="tech.php">Технологии и термины</a></li><li><a href="cabinet.php">Личный кабинет</a></li><li><a href="admin.php">Админ-панель</a></li><li><a href="logout.php" style="color:#ef4444;">Выйти</a></li></ul></div></nav>

<main class="container">
    <div class="page-section">
        <h2>Админ-панель</h2>
        <div class="admin-controls">
            <h3>Управление заявками</h3>
            <?php
            $stmt = $pdo->query("SELECT a.*, u.name as user_name FROM applications a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
            $apps = $stmt->fetchAll();
            foreach ($apps as $app):
            ?>
            <div class="application-card" style="margin-bottom:20px;">
                <strong>Заявка №<?= $app['id'] ?></strong> — Клиент: <?= htmlspecialchars($app['user_name']) ?><br>
                Тип: <?= htmlspecialchars($app['expertise_type']) ?><br>
                Авто: <?= htmlspecialchars($app['car_brand'] ?? '—') ?> <?= htmlspecialchars($app['car_model'] ?? '') ?><br>
                <form method="POST" style="margin-top:10px;">
                    <input type="hidden" name="app_id" value="<?= $app['id'] ?>">
                    <select name="status">
                        <option value="new" <?= $app['status']=='new' ? 'selected' : '' ?>>Новая</option>
                        <option value="expert" <?= $app['status']=='expert' ? 'selected' : '' ?>>Эксперт назначен</option>
                        <option value="inspection" <?= $app['status']=='inspection' ? 'selected' : '' ?>>Осмотр проведен</option>
                        <option value="ready" <?= $app['status']=='ready' ? 'selected' : '' ?>>Отчет готов</option>
                    </select>
                    <input type="text" name="report_url" placeholder="Ссылка на отчет (PDF)" value="<?= htmlspecialchars($app['report_url'] ?? '') ?>" style="width:300px;">
                    <button type="submit" name="update">Сохранить</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<footer><div class="container footer-inner"><div>© 2025 Независимые эксперты</div><div><i class="fas fa-phone-alt"></i> +7 (495) 123-45-67</div></div></footer>
<script src="script.js"></script>
</body>
</html>