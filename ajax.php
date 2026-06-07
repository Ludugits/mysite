<?php
require_once 'partials/db.php';
header('Content-Type: application/json; charset=utf-8');

// ══════════════════════════════════════
// GET — вернуть все заявки из БД
// ══════════════════════════════════════
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT id, name, email, phone, message, created_at FROM feedback ORDER BY created_at DESC");
    $rows = $stmt->fetchAll();
    echo json_encode(['success' => true, 'count' => count($rows), 'data' => $rows], JSON_UNESCAPED_UNICODE);
    exit;
}

// ══════════════════════════════════════
// POST — сохранить заявку
// ══════════════════════════════════════
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Метод не поддерживается']);
    exit;
}

$name       = trim($_POST['name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$phone      = trim($_POST['phone'] ?? '');
$message    = trim($_POST['message'] ?? '');
$newsletter = isset($_POST['newsletter']) ? 1 : 0;
$car_ids    = $_POST['car_ids'] ?? [];

$errors = [];
if (empty($name))                                                 $errors[] = 'Имя обязательно для заполнения';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))  $errors[] = 'Укажите корректный e-mail';
if (empty($phone))                                                $errors[] = 'Телефон обязателен для заполнения';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode('. ', $errors)]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO feedback (name, email, phone, message, newsletter, created_at)
        VALUES (:name, :email, :phone, :message, :newsletter, NOW())
    ");
    $stmt->execute([
        ':name'       => $name,
        ':email'      => $email,
        ':phone'      => $phone,
        ':message'    => $message,
        ':newsletter' => $newsletter,
    ]);
    $feedback_id = $pdo->lastInsertId();

    if (!empty($car_ids)) {
        $stmt2 = $pdo->prepare("
            INSERT INTO feedback_items (feedback_id, item_id) VALUES (:feedback_id, :item_id)
        ");
        foreach ($car_ids as $car_id) {
            $car_id = (int) $car_id;
            if ($car_id > 0) {
                $stmt2->execute([':feedback_id' => $feedback_id, ':item_id' => $car_id]);
            }
        }
    }

    echo json_encode([
        'success'     => true,
        'message'     => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.',
        'feedback_id' => $feedback_id,
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Ошибка БД: ' . $e->getMessage()]);
}