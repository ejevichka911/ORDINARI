<?php
// Подключние к БД
require_once 'databases/db.php';

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    error_log("Метод запроса: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['message' => 'Неверный метод запроса']);
    exit;
}

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents("php://input"), true);
$articleToDelete = $data['article']; // Артикул товара для удаления

// Подготовка SQL-запроса
$stmt = $pdo->prepare("DELETE FROM products WHERE article = :article");
$stmt->bindParam(':article', $articleToDelete);

// Выполнение запроса
if ($stmt->execute()) {
    echo json_encode(['message' => 'Товар успешно удален']);
} else {
    echo json_encode(['message' => 'Ошибка при удалении товара']);
}
?>