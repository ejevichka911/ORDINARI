<?php
    header('Content-Type: application/json');

// Подключаем файл с подключением к БД
require 'databases/db.php';

// Подключаем файл с функцией транслитерации
include 'php/transliterate.php';

// Генерация страниц для каждого товара
function generate_pages() {
    global $pdo; // Используем глобальную переменную для доступа к PDO

    // Извлечение данных о товарах из базы данных
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    echo json_encode($products, JSON_UNESCAPED_UNICODE);

    $existingFiles = [];
    $urlData = []; // Массив для хранения оригинальных имен и URL

    // Создаем страницы для существующих товаров
    foreach ($products as $product) {
        // Проверяем, что все необходимые данные присутствуют
        if (!isset($product['name'], $product['main_price'], $product['old_price'], $product['full_description'], $product['brief_description'], $product['article'], $product['image_paths'], $product['category'], $product['characteristics'])) {
            continue; // Пропускаем товары с отсутствующими данными
        }

        $productName = htmlspecialchars($product['name']);
        $productMainPrice = htmlspecialchars($product['main_price']);
        $productOldPrice = htmlspecialchars($product['old_price']);
        $productFullDescription = htmlspecialchars($product['full_description']);
        $productBriefDescription = htmlspecialchars($product['brief_description']);
        $productArticle = htmlspecialchars($product['article']);
        $domain = 'https://ordinari.ru/'; // Замените на ваш домен
        $productImage = $domain . htmlspecialchars($product['image_paths'][0]); // Берем первое изображение и добавляем домен
        $category = htmlspecialchars($product['category']);
        $characteristics = isset($product['characteristics']) ? htmlspecialchars($product['characteristics']) : "Нет характеристик";
      
      $characteristics = json_decode($product['characteristics'], true);

        // Создаем директорию для категории внутри папки pages, если она не существует
        $categoryPath = "pages/$category";
        if (!is_dir($categoryPath)) {
            if (!mkdir($categoryPath, 0777, true)) {
                throw new Exception("Не удалось создать директорию: $categoryPath");
            }
            echo "Создана директория: $categoryPath\n";
        }

        // Используем функцию транслитерации для создания имени файла
        $transliteratedName = transliterate($productName);
        $fileName = preg_replace('/[^a-zA-Z0-9-_\.]/u', '_', $transliteratedName) . '.php';
        $existingFiles[] = "$categoryPath/$fileName"; // Сохраняем путь к существующему файлу

        // Создаем контент страницы товара на основе шаблона
        $content = <<<EOD
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="$productBriefDescription">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$productName</title>
    <link rel="stylesheet" href="https://ordinari.ru/assets/styles/styles-core.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="https://ordinari.ru/assets/img/photo1-16.png">
    <link rel="stylesheet" href="https://ordinari.ru/css/style_page.css" />
</head>
<body class="sb-body-shap">
    <div id="darkOverlay" class="dark-overlay"></div>
    <div class="sb-body-shap-sa">
        <div class="shap-sa-top"></div>
        <div class="shap-mon-bottom">
            <div class="shap-mon-left">
                <div class="shap-mon-left-image">
                    <div class="thumbnail-container" id="thumbnailContainer">
                    </div>
                <div class="shap-mon-left-image">
                    <img id="currentImage" src="$productImage" alt="Текущее изображение" style="width: 70%; height: auto;">
                </div>
                </div>
            </div>
            <div class="shap-mon-right">
                <div class="shap-mon-right-info">
                    <div class="info-zag" id="product-name">$productName</div>
                    <div class="info-article" id="product-article">$productArticle</div>
                    <div class="info-price" id="product-price">$productMainPrice руб.</div>
                    <div class="separator"></div>
                    <div class="description-title" onclick="toggleVisibility('full-description', this)">
                        Описание
                        <img src="https://ordinari.ru/assets/img/next.png" alt="Next" class="arrow" />
                    </div>
                    <div id="full-description" class="full-description hidden slide-down">
                        $productFullDescription
                    </div>
                    <div class="separator"></div>
                    <div class="characteristics-title" onclick="toggleVisibility('characteristics', this)">
                        Характеристики
                        <img src="https://ordinari.ru/assets/img/next.png" alt="Next" class="arrow" />
                    </div>
                    <div id="characteristics" class="characteristics hidden slide-down">
                        $characteristics
                    </div>
                    <div class="separator"></div>
                        <div class="button-container">
                        <button id="buy" class="shap-mon-button-bottom add-to-cart">В корзину</button>
                        <button id="favorite" class="favorite">
                            <img src="https://ordinari.ru/assets/img/Heart.png" alt="Favorite" style="width: 20px; height:  20px;">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ordinari.ru/js/pages_card.js"></script>

    <?php include '../../menu-burger/menu.php' ?>

    <?php include '../../menu-burger/sidebar.php' ?>

</body>
</html>
EOD;

        // Записываем контент в файл
        file_put_contents("$categoryPath/$fileName", $content);
        echo "Создана страница товара: $category/$fileName\n";

        // Сохраняем оригинальное имя и URL в массив
        $urlData[] = [
            'original_name' => $productName,
            'url' => "$domain/$categoryPath/$fileName"
        ];
    }

    // Вставка данных в базу данных
    foreach ($urlData as $data) {
        $stmt = $pdo->prepare("INSERT INTO product_urls (original_name, url) VALUES (:original_name, :url)");
        $stmt->bindParam(':original_name', $data['original_name']);
        $stmt->bindParam(':url', $data['url']);
        $stmt->execute();
    }
    echo "Сохранены оригинальные имена и URL в базу данных.\n";

    return $existingFiles;
}

// Запускаем генерацию страниц
try {
    generate_pages();
    echo "Все страницы товаров успешно сгенерированы.\n";
} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage() . "\n";
}
?>