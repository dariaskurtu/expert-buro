<?php
require_once 'config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

if ($action === 'calculate') {
    $type = $data['type'] ?? '';
    $brand = $data['brand'] ?? '';
    $visit = $data['visit'] ?? 'no';
    
    $price = 3000;
    if ($type === 'dtp') $price = 4900;
    elseif ($type === 'court') $price = 25000;
    elseif ($type === 'inheritance') $price = 3500;
    elseif ($type === 'casco') $price = 5500;
    
    if ($brand === 'premium') $price += 2000;
    if ($visit === 'yes') $price += 1500;
    
    echo json_encode(['price' => $price]);
    exit;
}

if ($action === 'create_application') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'Необходимо войти в систему']);
        exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO applications (user_id, expertise_type, car_brand, car_model, need_expert_visit, estimated_price, status, status_text) VALUES (?, ?, ?, ?, ?, ?, 'new', 'Новая')");
    $stmt->execute([
        $_SESSION['user_id'],
        $data['expertise_type'] ?? '',
        $data['car_brand'] ?? '',
        $data['car_model'] ?? '',
        $data['need_visit'] ?? 0,
        $data['estimated_price'] ?? 0
    ]);
    
    echo json_encode(['success' => true]);
    exit;
}
?>