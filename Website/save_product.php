<?php
// Подключение к базе данных (используем внешний файл)
require_once 'databases/db.php';

// Проверяем, что соединение установлено, прежде чем продолжить
if (!$pdo) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Ошибка: Не удалось установить соединение с базой данных.']);
    exit;
}

$table = 'products'; // Имя таблицы
$targetDir = 'assets/img/'; // Папка для сохранения изображений

// Функция для логирования ошибок
function logError($message) {
    error_log('[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL, 3, 'error.log');
}

try {
    // 1. Получение данных из POST-запроса
    $productName = $_POST['product_name'] ?? '';
    $mainPrice = $_POST['main_price'] ?? '';
    $oldPrice = $_POST['old_price'] ?? '';
    $fullDescription = $_POST['full_description'] ?? '';
    $briefDescription = $_POST['brief_description'] ?? '';
    $article = $_POST['article'] ?? '';
    $unitOfMeasurement = $_POST['unit-of-measurement'] ?? '';
    $category = $_POST['category'] ?? '';
    $characteristics = $_POST['characteristics'] ?? '';

    // 2. Валидация данных
    if (empty($productName)) {
        logError("Ошибка: название товара не может быть пустым");
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Ошибка: название товара не может быть пустым']);
        exit;
    }
    if (!is_numeric($mainPrice) || $mainPrice < 0) {
        logError("Ошибка: основная цена должна быть положительным числом");
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Ошибка: основная цена должна быть положительным числом']);
        exit;
    }

    // 3. Обработка загрузки изображений
    $imagePaths = [];
    if (isset($_FILES['product-image']) && is_array($_FILES['product-image']['name'])) {
        foreach ($_FILES['product-image']['name'] as $key => $name) {
            if ($_FILES['product-image']['error'][$key] === UPLOAD_ERR_OK) {
                $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $imagePath = $targetDir . uniqid() . '.' . $imageFileType;

                if (move_uploaded_file($_FILES['product-image']['tmp_name'][$key], $imagePath)) {
                    $imagePaths[] = $imagePath;
                } else {
                    logError("Ошибка при загрузке изображения");
                    header('Content-Type: application/json');
                    echo json_encode(['message' => 'Ошибка при загрузке изображения']);
                    exit;
                }
            }
        }
    }

    if (empty($imagePaths)) {
        logError("Ошибка: необходимо загрузить хотя бы одно изображение");
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Ошибка: необходимо загрузить хотя бы одно изображение']);
        exit;
    }

    // 4. Подготовка SQL-запроса
    $sql = "INSERT INTO $table (name, main_price, old_price, full_description, brief_description, article, unit_of_measurement, category, characteristics, image_paths) 
            VALUES (:name, :main_price, :old_price, :full_description, :brief_description, :article, :unit_of_measurement, :category, :characteristics, :image_paths)";

    $stmt = $pdo->prepare($sql);

    // 5. Преобразование данных и привязка параметров
    $imagePathsString = implode(',', $imagePaths);
    $characteristicsJson = json_encode($characteristics);

    $stmt->bindValue(':name', $productName);
    $stmt->bindValue(':main_price', $mainPrice);
    $stmt->bindValue(':old_price', $oldPrice);
    $stmt->bindValue(':full_description', $fullDescription);
    $stmt->bindValue(':brief_description', $briefDescription);
    $stmt->bindValue(':article', $article);
    $stmt->bindValue(':unit_of_measurement', $unitOfMeasurement);
    $stmt->bindValue(':category', $category);
    $stmt->bindValue(':characteristics', $characteristicsJson);
    $stmt->bindValue(':image_paths', $imagePathsString);

    // 6. Выполнение запроса
    if ($stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Товар успешно добавлен в базу данных']);
      
        include 'generate_pages.php';
    } else {
        logError("Ошибка при добавлении товара: " . $stmt->errorInfo()[2]);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Ошибка при добавлении товара в базу данных']);
    }

} catch (Exception $e) {
    // Обработка ошибок
    logError("Error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Произошла ошибка: ' . $e->getMessage()]);

}
?>