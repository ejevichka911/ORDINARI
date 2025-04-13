<?php
require '../databases/db.php'; // Подключение к базе данных

// Получение данных о продуктах
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category");
    $stmt->execute(['category' => $category]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
    exit; // Завершаем выполнение скрипта после отправки ответа
}

// Получение URL продуктов
if (isset($_GET['urls'])) {
    $stmt = $pdo->query("SELECT original_name, url FROM product_urls");
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($urls);
    exit; // Завершаем выполнение скрипта после отправки ответа
}
?>