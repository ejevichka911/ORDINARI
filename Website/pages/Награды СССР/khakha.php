<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="ХА-ХА">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ХАХА</title>
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
                    <img id="currentImage" src="https://ordinari.ru/a" alt="Текущее изображение" style="width: 70%; height: auto;">
                </div>
                </div>
            </div>
            <div class="shap-mon-right">
                <div class="shap-mon-right-info">
                    <div class="info-zag" id="product-name">ХАХА</div>
                    <div class="info-article" id="product-article">HFUE</div>
                    <div class="info-price" id="product-price">2323.00 руб.</div>
                    <div class="separator"></div>
                    <div class="description-title" onclick="toggleVisibility('description', this)">
                        Описание
                        <img src="https://ordinari.ru/assets/img/next.png" alt="Next" class="arrow" />
                    </div>
                    <div id="description" class="full-description hidden slide-down">
                        ХАХАХА
                    </div>
                    <div class="separator"></div>
                    <div class="characteristics-title" onclick="toggleVisibility('characteristics', this)">
                        Характеристики
                        <img src="https://ordinari.ru/assets/img/next.png" alt="Next" class="arrow" />
                    </div>
                    <div id="characteristics" class="characteristics hidden slide-down">
                        &quot;\u0425\u0410&quot;
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
    <script src="../../js/pages_card.js"></script>

    <?php include '../../menu-burger/menu.php' ?>

    <?php include '../../menu-burger/sidebar.php' ?>

</body>
</html>