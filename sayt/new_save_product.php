<?php

require 'databases/db.php';

// Проверяем, были ли отправлены данные формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $productName = $_POST['product_name'] ?? '';
    $mainPrice = $_POST['main_price'] ?? '';
    $oldPrice = $_POST['old_price'] ?? '';
    $fullDescription = $_POST['full_description'] ?? '';
    $briefDescription = $_POST['brief_description'] ?? '';
    $article = $_POST['article'] ?? '';
    $unitOfMeasurement = $_POST['unit-of-measurement'] ?? '';
    $category = $_POST['category'] ?? '';
    $images = $_FILES['product-image'] ?? [];

    // Валидация данных
    if (empty($productName)) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка: название товара не может быть пустым']);
        exit;
    }
    if (!is_numeric($mainPrice) || $mainPrice < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка: основная цена должна быть положительным числом']);
        exit;
    }

    // Подготовка SQL-запроса для добавления товара
    $sql = "INSERT INTO products (name, main_price, old_price, full_description, brief_description, article, unit_of_measurement) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Проверяем, успешно ли подготовлен запрос
    if ($stmt === false) {
        die("Ошибка при подготовке запроса: " . $conn->error);
    }

    // Привязываем параметры
    $stmt->bind_param('sssssss', $productName, $mainPrice, $oldPrice, $fullDescription, $briefDescription, $article, $unitOfMeasurement);

    // Выполняем запрос
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => "Ошибка при добавлении товара: " . $stmt->error]);
        exit;
    }

    // Получаем ID последнего вставленного товара
    $lastId = $stmt->insert_id;

    // Обработка загруженных изображений
    $imagePaths = []; // Массив для хранения путей к изображениям
    if (isset($images) && is_array($images['name'])) {
        $targetDir = 'assets/img/'; // Папка для сохранения изображений

        foreach ($images['name'] as $key => $name) {
            if ($images['error'][$key] === UPLOAD_ERR_OK) {
                $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $imagePath = $targetDir . uniqid('product_', true) . '.' . $imageFileType; // Генерируем уникальное имя файла

                // Перемещаем загруженный файл в целевую папку
                if (move_uploaded_file($images['tmp_name'][$key], $imagePath)) {
                    // Сохраняем путь к изображению в массив
                    $imagePaths[] = $imagePath;

                    // Сохраняем информацию о изображении в базе данных
                    $sqlImage = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
                    $stmtImage = $conn->prepare($sqlImage);
                    $stmtImage->bind_param('is', $lastId, $imagePath);
                    $stmtImage->execute();
                    $stmtImage->close();
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Ошибка при загрузке изображения: " . $images['error'][$key]]);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => "Ошибка: изображение не загружено. Код ошибки: " . $images['error'][$key]]);
                exit;
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "Ошибка: изображения не загружены."]);
        exit;
    }

    $stmt->close();
    $conn->close();

    // Возвращаем успешный ответ
    echo json_encode(['status' => 'success', 'message' => 'Товар и изображения успешно сохранены']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка: неверный метод запроса']);
}
?>