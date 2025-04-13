<?php

require 'databases/db.php'; // Убедитесь, что путь к файлу подключения правильный

try {
    // Запрос к таблице products
    $sql = "SELECT id, name, article, category, main_price, image_paths FROM products"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    // Возвращаем данные в формате JSON
    echo json_encode($products);
} catch (PDOException $e) {
    // Если произошла ошибка, возвращаем сообщение об ошибке
    echo json_encode(['status' => 'error', 'message' => "Ошибка при выполнении запроса: " . $e->getMessage()]);
    exit;
} catch (Exception $e) {
    // Обработка других исключений
    echo json_encode(['status' => 'error', 'message' => "Общая ошибка: " . $e->getMessage()]);
    exit;
}
?>