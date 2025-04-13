<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары сайта "ordinari"</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/photo1-16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/photo1-32.png" />
    <link rel="icon" type="image/png" sizes="120x120" href="../assets/img/photo1-120.png" />
    <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="../assets/img/photo1-120.png" />
    <link rel="icon" type="image/png" sizes="180x180" href="../assets/img/photo1-180.png" />
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="../assets/img/photo1-180.png" />

  <link rel="stylesheet" href="https://ordinari.ru/css/style-spisok.css?v=<?php echo time(); ?>">
</head>
<body>
	<div class="bold-text-container">
		<h1 class="bold-text">Товары сайта «ordinari»</h1>
		<button class="add-product-button" onclick="location.href='https://ordinari.ru/adding%20product.php'">Добавить товар</button>
	</div>
	<div class="search-container">
		<div>
			<input type="search" id="search-input" class="search-input search-input-icon" placeholder="Поиск по названию или артикулу">
		</div>
		<div class="search-input-category">
			<input type="search" id="search-input-category" class="search-input" placeholder="Поиск по категориям">
			<ul class="search-input-category-list">
			</ul>
		</div>
	</div>
	<div class="window" id="window">
  		<div class="window-content">
    		<div class="product-list-header">
  				<div class="column-box">
    				<input type="checkbox" id="select-all" class="checkbox">
  				</div>
  				<div class="column" data-sort-key="name">
    				Наименование
    				<span class="sort-icon-wrapper">
      					<img src="assets/img/sort-edited.png" alt="Sort icon" class="sort-icon asc">
    				</span>
  				</div>
  				<div class="column" data-sort-key="article">
					Артикул
					<span class="sort-icon-wrapper">
      					<img src="assets/img/sort-edited.png" alt="Sort icon" class="sort-icon asc">
    				</span>
				</div>
  				<div class="column">Категория</div>
  				<div class="column" data-sort-key="price">
					Цена
					<span class="sort-icon-wrapper">
      					<img src="assets/img/sort-edited.png" alt="Sort icon" class="sort-icon asc">
    				</span>
				</div>
  				<div class="column-zero"></div>
			</div>
    		<div id="product-list"></div>
  		</div>
	</div>

    <script>
        let products = [];

        function loadProducts() {
            fetch('get_products.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Сетевая ошибка');
                }
                return response.json();
            })
            .then(data => {
                products = data;
                renderProductList(products);
            })
            .catch(error => console.error('Ошибка при загрузке данных:', error));
        }
          
        function renderProductList(products = []) {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';

            products.forEach((product) => {
                const imagePaths = product.image_paths.split(',');
                const productListItem = document.createElement('div');
                productListItem.classList.add('product-list-item');
                productListItem.dataset.productId = product.article; // Используем артикул как идентификатор

                productListItem.innerHTML = `
                    <div class="column-box">
                        <input type="checkbox">
                    </div>
                    <div class="column">
                        <div style="display: flex; align-items: center;">
                            <span class="pro-name">${product.name}</span>
                            <img src="${imagePaths[0]}" alt="${product.name}">
                        </div>
                    </div>
                    <div class="column">${product.article}</div>
                    <div class="column">${product.category}</div>
                    <div class="column">${product.main_price} &#8381;</div>
                    <div class="column-zero">
                        <button class="dots-button">
                            <span>...</span>
                        </button>
                        <div class="dropdown-menu">
                            <ul>
                                <li><button class="duplicate-button">Дублировать</button></li>
                                <li><button class="delete-button" data-article="${product.article}">Удалить</button></li>
                            </ul>
                        </div>
                    </div>
                `;
                productList.appendChild(productListItem);
            });

            // Добавляем обработчики событий для кнопок "Удалить" и "Дублировать"
            attachDeleteEventListeners();
            attachDuplicateEventListeners()
            attachDotsButtonListeners();
        }
                  
        loadProducts();
              
        function attachDuplicateEventListeners() {
            document.querySelectorAll('.duplicate-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const article = this.closest('.product-list-item').dataset.productId; // Получаем артикул товара
                    duplicateProduct(article);
                });
            });
        }

        function duplicateProduct(article) {
            const productToDuplicate = products.find(product => product.article === article);
            if (productToDuplicate) {
                // Создаем новый объект товара, изменяя категорию
                const newProduct = {
                    name: productToDuplicate.name,
                    main_price: productToDuplicate.main_price,
                    old_price: productToDuplicate.old_price,
                    full_description: productToDuplicate.full_description,
                    brief_description: productToDuplicate.brief_description,
                    article: generateNewArticle(productToDuplicate.article), // Генерируем новый артикул
                    unit_of_measurement: productToDuplicate.unit_of_measurement,
                    category: productToDuplicate.category, // Изменяем категорию
                    characteristics: productToDuplicate.characteristics,
                    image_paths: productToDuplicate.image_paths // Копируем пути к изображениям
                };
            
                // Отправляем новый товар на сервер
                saveProduct(newProduct);
            } else {
                alert('Товар не найден для дублирования.');
            }
        }

        function generateNewArticle(oldArticle) {
            // Генерируем новый артикул, добавляя к старому номер (например, "_copy")
            return oldArticle;
        }

        function saveProduct(product) {
            const formData = new FormData();
            formData.append('product_name', product.name);
            formData.append('main_price', product.main_price);
            formData.append('old_price', product.old_price);
            formData.append('full_description', product.full_description);
            formData.append('brief_description', product.brief_description);
            formData.append('article', product.article);
            formData.append('unit-of-measurement', product.unit_of_measurement);
            formData.append('category', product.category);
            formData.append('characteristics', product.characteristics);

            // Если у вас есть изображения, добавьте их в formData
            product.image_paths.forEach((imagePath, index) => {
                formData.append('product-image[]', imagePath); // Предполагается, что вы передаете пути к изображениям
            });
        
            fetch('save_product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Сетевая ошибка при сохранении товара');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                // Обновляем список товаров после успешного сохранения
                loadProducts(); // Перезагружаем список товаров
            })
            .catch(error => {
                console.error('Ошибка при сохранении товара:', error);
            });
        }
      
        function attachDeleteEventListeners() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const article = this.dataset.article;
                    deleteProduct(article); 
                });
            });
        }

        function deleteProduct(article) {
            console.log("Удаляем товар с артикулом:", article);
            fetch('delete_product.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ article: article })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Сетевая ошибка');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.message === 'Товар успешно удален') {
                    products = products.filter(product => product.article !== article);
                    renderProductList(products);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при удалении товара.');
            });
        }
      
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('#product-list input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
       
        function attachDotsButtonListeners() {
            document.querySelectorAll('.dots-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                });
            });
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-menu') && !event.target.classList.contains('dots-button')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });

        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            const filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchTerm) || 
                product.article.toLowerCase().includes(searchTerm) || 
                product.category.toLowerCase().includes(searchTerm)
            );
            renderProductList(filteredProducts);
        });
                  
        loadProducts();
	</script>
</body>
</html>