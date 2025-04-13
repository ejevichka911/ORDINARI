<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Начинаем сессию

// Функция для чтения товаров из JSON файла
function getProducts() {
    $url = 'https://ordinari.eu/databases/data.json';
    
    // Используем cURL для получения данных
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    
    if (curl_errno($ch)) {
        throw new Exception("Ошибка cURL: " . curl_error($ch));
    }
    
    curl_close($ch);
    
    if ($data === false) {
        throw new Exception("Ошибка чтения файла JSON");
    }
    
    $products = json_decode($data, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Ошибка декодирования JSON: " . json_last_error_msg());
    }
    
    return $products;
}

// Проверяем, был ли отправлен запрос
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['article'])) {
    $productArticle = $_GET['article']; // Получаем артикул товара из GET-запроса
    $products = getProducts();

    // Ищем товар по артикулу
    foreach ($products as $product) {
        if ($product['article'] === $productArticle) { // Предполагаем, что article уникален
            // Сохраняем информацию о товаре в сессии
            $_SESSION['product_info'] = [
                'name' => $product['name'],
                'price' => $product['main_price'],
                'image' => $product['image_paths'][0], // Берем первое изображение
            ];
            // Перенаправляем на вторую страницу
            header("Location: https://ordinari.ru/menu-burger/sidebar.php");
            exit;
        }
    }
    echo json_encode(['success' => false, 'message' => 'Товар не найден']);
    exit;
}
?>