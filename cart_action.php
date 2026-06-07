<?php
session_start();
require_once 'partials/db.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$car_id = (int) ($_POST['car_id'] ?? $_GET['car_id'] ?? 0);

switch ($action) {
    case 'add':
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->execute([':id' => $car_id]);
        $car = $stmt->fetch();
        if ($car) {
            if (isset($_SESSION['cart'][$car_id])) {
                $_SESSION['cart'][$car_id]['quantity']++;
            } else {
                $_SESSION['cart'][$car_id] = [
                    'id'           => $car['id'],
                    'name'         => $car['name'],
                    'manufacturer' => $car['manufacturer'],
                    'year'         => $car['year'],
                    'price'        => $car['price'],
                    'image'        => $car['image'],
                    'quantity'     => 1,
                ];
            }
            echo json_encode(['success' => true, 'count' => array_sum(array_column($_SESSION['cart'], 'quantity')), 'message' => $car['name'] . ' добавлен в корзину']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Автомобиль не найден']);
        }
        break;

    case 'remove':
        unset($_SESSION['cart'][$car_id]);
        echo json_encode(['success' => true, 'count' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
        break;

    case 'clear':
        $_SESSION['cart'] = [];
        echo json_encode(['success' => true, 'count' => 0]);
        break;

    case 'count':
        echo json_encode(['count' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Неизвестное действие']);
}
