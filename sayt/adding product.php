<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание товара</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/photo1-16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/photo1-32.png">
    <link rel="icon" type="image/png" sizes="120x120" href="../assets/img/photo1-120.png">
    <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="../assets/img/photo1-120.png">
    <link rel="icon" type="image/png" sizes="180x180" href="../assets/img/photo1-180.png">
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="../assets/img/photo1-180.png">

    <link rel="stylesheet" type="text/css" href="../css/style-adding.css">
</head>
<body>
    <div class="background"></div>
    <div class="window">
        <div class="window-container">
          
            <div class="window-input-container">
                <button class="back-button" onclick="goToProducts()">
                  <img src="assets/img/next.png" alt="Back icon" class="icon-back" style="transform: rotate(180deg);">Товары
                </button>
                <div class="input-container">
                  <form id="productForm" action="save_product.php/" method="POST" enctype="multipart/form-data">
                        <img src="assets/img/edit-svgrepo-com.svg" class="icon" alt="Describe icon" id="editIcon" onclick="editProduct()">
                        <input type="text" id="product-name" name="product_name" placeholder="Наименование товара" required autocomplete="off">
                        <div id="suggestions" class="suggestion-dropdown hidden"></div>
                </div>
                <div class="container">
                    <div class="about-product">
                        <h2 class="product">О товаре</h2>
                        <div class="line"></div>
                        <h2 class="price">Цена</h2>
                        <div class="main-price-container">
                            <p class="main-price">Основная цена</p>
                            <div class="price-wrapper">
                                <input type="number" id="price-input" class="price-input" name="main_price" placeholder="0" min="0">
                                <span class="currency-symbol">&#8381;</span>
                            </div>
                        </div>
                        <div class="main-price-container">
                            <p class="main-price">Старая цена</p>
                            <div class="old-price-wrapper">
                                <input type="number" id="old-price-input" class="old-price-input" name="old_price" placeholder="0" min="0">
                                <span class="currency-symbol">&#8381;</span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="description-container">
                            <h2 class="description">Описание</h2>
                            <textarea class="full-input" name="full_description" placeholder="Полное описание товара" oninput="autoResize(this)"></textarea>
                            <h3>Дополнительное описание</h3>
                            <textarea class="brief-input" name="brief_description" placeholder="Уточнение, касающиеся товара" oninput="autoResize(this)"></textarea>
                        </div>
                        <div class="line"></div>
                        <div class="product-options-container">
                            <h2 class="product-options">Характеристики</h2>
                            <textarea type="text" id="characteristics-input" name="characteristics" placeholder="Размеры изделия" class="full-input"></textarea>
                        </div>
                        <div class="line"></div>
                        <div class="article-container">
                            <h2 class="article">Артикул</h2>
                            <input type="text" id="article-name" name="article" placeholder="Введите артикул" autocomplete="off">
                        </div>
                        <div class="line"></div>
                        <div class="unit-of-measurement-container">
                            <h2 class="unit-of-measurement">Единица измерения</h2>
                            <input type="text" id="unitInput" name="unit-of-measurement" placeholder="Введите единицу измерения" value="Шт" />
                        </div>
                    </div>
                </div>
            </div>
              
            <div class="right-window-container">
                <div class="right-window">
                    <h2 class="photo">Фотографии</h2>
                    <div class="upload-area" id="uploadArea">
                        <label for="product-image" class="upload-button" style="pointer-events: none;">
                            <span class="choose-file-text">Выберите файл</span>
                        </label>
                        <input type="file" class="product-image" name="product-image[]" accept="image/png, image/jpeg, image/jpg" id="product-image" multiple required onchange="handleFiles()" style="display: none;">
                            <span class="drag-file-text">или перетащите их сюда</span>
                        </div>
                    <div id="imagePreviewContainer" class="image-preview-container"></div>
                </div>
                <div class="product-categories-container">
                    <h2 class="product-categories">Категории товара</h2>
                    <div class="input-field">
                        <input type="text" id="productCategoryInput" name="category" class="categories-input" placeholder="Категория" autocomplete="off" oninput="showCategories()" />
                        <div id="categoriesDropdown" class="dropdown"></div>
                    </div>
                </div>
                <button type="submit" class="large-yellow-button" id="submitButton">Сохранить товар</button>
                </form>
            </div>
          
        </div>
    </div>
    <script>
    // Вызываем функцию для отображения категорий при загрузке страницы
    showCategories();

    let uploadedFiles = []; // Массив для хранения загруженных файлов

    // Обработчик события для перетаскивания файлов
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('product-image');
    const previewContainer = document.getElementById('imagePreviewContainer');

    // Обработчик события для клика по области загрузки
    uploadArea.addEventListener('click', () => {
        fileInput.click(); // Вызываем клик на скрытом input для выбора файла
    });

    // Предотвращаем стандартное поведение при перетаскивании
    uploadArea.addEventListener('dragover', (event) => {
        event.preventDefault();
    });

    // Обрабатываем файлы при сбросе
    uploadArea.addEventListener('drop', (event) => {
        event.preventDefault();
        const files = event.dataTransfer.files; // Получаем файлы из события
        handleFiles(files); // Убедитесь, что files не undefined
    });

    // Обработчик события для выбора файлов через кнопку
    fileInput.addEventListener('change', (event) => {
        const files = event.target.files; // Убедитесь, что files определен
        handleFiles(files); // Передаем files в функцию
    });

    // Функция для обработки загруженных файлов
    function handleFiles(files) {
        if (!files) files = [];
        if (uploadedFiles.length + files.length > 10) return alert("Вы можете загрузить не более 10 изображений.");

        const previewContainer = document.getElementById('imagePreviewContainer');
        const uniqueFiles = new Set(uploadedFiles.map(file => file.name));

        for (const file of files) {
            if (!uniqueFiles.has(file.name)) {
                uploadedFiles.push(file);
                uniqueFiles.add(file.name);

                const reader = new FileReader();
                reader.onload = (e) => {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'image-container';
                    imgContainer.id = file.name; // Назначаем ID контейнеру

                    const img = document.createElement('img');
                    img.src = e.target.result; // Устанавливаем источник изображения
                    img.classList.add('preview-image'); // Добавьте класс для стилизации

                    const deleteIcon = document.createElement('img');
                    deleteIcon.src = 'assets/img/trash_white.svg'; // Путь к иконке
                    deleteIcon.classList.add('delete-icon'); // Добавьте класс для стилизации
                    deleteIcon.onclick = function() {
                        uploadedFiles = uploadedFiles.filter(uploadedFile => uploadedFile.name !== file.name); // Исправлено
                        removeFile(file.name); // Исправлено
                    };

                    imgContainer.appendChild(img); // Добавляем изображение в контейнер
                    imgContainer.appendChild(deleteIcon); // Добавляем иконку удаления в контейнер
                    previewContainer.appendChild(imgContainer); // Добавляем контейнер в основной контейнер
                };
                reader.readAsDataURL(file);
            }
        }
    }

    function removeFile(fileName) {
        // Удаляем файл из массива
        uploadedFiles = uploadedFiles.filter(file => file.name !== fileName);

        // Удаляем элемент превью из DOM
        const imgContainer = document.getElementById(fileName);
        if (imgContainer) {
            imgContainer.remove(); // Удаляем контейнер изображения
        }
    }

    document.getElementById('productForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Предотвращаем стандартную отправку формы

        // Проверка на наличие загруженных файлов
        if (uploadedFiles.length === 0) {
            alert('Пожалуйста, загрузите хотя бы одно изображение.');
            return;
        }

        const productName = document.getElementById('product-name').value;
        const mainPrice = document.querySelector('.price-input').value;
        if (!productName || !mainPrice) {
            alert('Пожалуйста, заполните все обязательные поля.');
            return;
        }

        const formData = new FormData(this);
        // Добавляем файлы к FormData
        uploadedFiles.forEach(file => {
            formData.append('product-image[]', file); // Добавьте файлы в FormData
        });

        fetch('save_product.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                // Обработка ответа сервера
            })
            .catch(error => {
                console.error('Ошибка:', error);
            })
            .finally(() => {
                window.location.href = "https://ordinari.ru/spisok.php";
            });
    });

    function goToProducts() {
        window.location.href = "https://ordinari.ru/spisok.php";
    }

    function autoResize(textarea) {
        textarea.style.height = 'auto'; // Сбрасываем высоту
        textarea.style.height = textarea.scrollHeight + 'px'; // Устанавливаем высоту в соответствии с содержимым
    }

    // Определяем функцию editProduct
    function editProduct() {
        const productNameInput = document.getElementById('product-name');
        const editIcon = document.getElementById('editIcon');

        // Включаем поле для редактирования и скрываем иконку
        productNameInput.disabled = false; // Включаем поле для редактирования
        productNameInput.focus(); // Устанавливаем фокус на поле
        editIcon.style.display = 'none'; // Скрываем иконку редактирования
    }

    // Обработчик для редактирования названия продукта
    document.getElementById('editIcon').addEventListener('click', editProduct);

    // Обработчик события для потери фокуса на поле ввода
    document.getElementById('product-name').addEventListener('blur', function() {
        const editIcon = document.getElementById('editIcon'); // Получаем иконку редактирования
        const productNameInput = document.getElementById('product-name');

        // Если поле ввода пустое, отключаем его и показываем иконку
        if (productNameInput.value.trim() === '') {
            productNameInput.disabled = true; // Отключаем поле
            editIcon.style.display = 'block'; // Показываем иконку редактирования
        }
    });

    // Обработчик события для фокуса на поле ввода
    document.getElementById('product-name').addEventListener('focus', function() {
        // Если поле ввода содержит текст-заполнитель, очищаем его
        if (this.value === '') {
            this.placeholder = ''; // Убираем текст-заполнитель
        } else {
            // Если в поле есть текст, скрываем иконку
            document.getElementById('editIcon').style.display = 'none';
        }
    });

    // Обработчик события для потери фокуса на поле ввода
    document.getElementById('product-name').addEventListener('blur', function() {
        // Если поле ввода пустое, возвращаем текст-заполнитель
        if (this.value === '') {
            this.placeholder = 'Наименование товара'; // Возвращаем текст-заполнитель
        } else {
            // Если поле не пустое, показываем иконку
            document.getElementById('editIcon').style.display = 'block';
        }
    });

    // Получаем элементы полей ввода цен
    const mainPriceInput = document.querySelector('.price-input');
    const oldPriceInput = document.querySelector('.old-price-input');

    // Обработчик события для фокуса на основном поле цены
    mainPriceInput.addEventListener('focus', function() {
        this.placeholder = ''; // Скрываем placeholder
        if (this.value === '0') {
            this.value = ''; // Очищаем поле, если значение равно 0
        }
    });

    // Обработчик события для потери фокуса на основном поле цены
    mainPriceInput.addEventListener('blur', function() {
        if (this.value === '') {
            this.placeholder = '0'; // Показываем placeholder
        } else {
            this.placeholder = ''; // Если поле не пустое, скрываем placeholder
        }
    });

    // Обработчик события для фокуса на старом поле цены
    oldPriceInput.addEventListener('focus', function() {
        this.placeholder = ''; // Скрываем placeholder
        if (this.value === '0') {
            this.value = ''; // Очищаем поле, если значение равно 0
        }
    });

    // Обработчик события для потери фокуса на старом поле цены
    oldPriceInput.addEventListener('blur', function() {
        if (this.value === '') {
            this.placeholder = '0'; // Показываем placeholder
        } else {
            this.placeholder = ''; // Если поле не пустое, скрываем placeholder
        }
    });

    // Функция для отображения категорий
    async function showCategories() {
        let categories = [];
        const input = document.getElementById('productCategoryInput');
        const dropdown = document.getElementById('categoriesDropdown');

        try {
            const response = await fetch('https://ordinari.ru/catalog.php');
            if (!response.ok) {
                throw new Error('Сеть не в порядке');
            }
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const h4Elements = doc.querySelectorAll('h4');

            categories = Array.from(h4Elements).map(element => {
                const text = element.textContent.trim();
                return { name: text };
            }).filter(category => category.name);

            function displayCategories(filter = '') {
                dropdown.innerHTML = '';
                const filteredCategories = categories.filter(category => {
                    return category.name.toLowerCase().includes(filter.toLowerCase());
                });

                if (filteredCategories.length > 0) {
                    dropdown.style.display = 'block';
                    filteredCategories.forEach(category => {
                        const item = document.createElement('div');
                        item.classList.add('dropdown-item');
                        item.textContent = category.name;

                        // Используем mousedown вместо click
                        item.onmousedown = function() {
                            input.value = category.name; // Устанавливаем выбранную категорию в поле ввода
                            dropdown.style.display = 'none';
                        };

                        dropdown.appendChild(item);
                    });
                } else {
                    const noResultsItem = document.createElement('div');
                    noResultsItem.classList.add('dropdown-item');
                    noResultsItem.textContent = 'Ничего не найдено';
                    noResultsItem.style.color = '#737676';
                    dropdown.appendChild(noResultsItem);
                    dropdown.style.display = 'block';
                }
            }

            input.addEventListener('focus', () => {
                displayCategories();
            });

            input.addEventListener('input', () => {
                displayCategories(input.value);
            });

            input.addEventListener('blur', () => {
                setTimeout(() => {
                    dropdown.style.display = 'none';
                }, 100);
            });
        } catch (error) {
            console.error('Ошибка при получении категорий:', error);
        }
    }
</script>
</body> 
</html>