if (!localStorage.getItem('reloaded')) {
    // Если страница не перезагружена, устанавливаем флаг в localStorage
    localStorage.setItem('reloaded', 'true');
    
    // Перезагружаем страницу, игнорируя кэш
    window.location.href = window.location.href.split('?')[0] + '?t=' + new Date().getTime();
} else {
    // Удаляем флаг из localStorage, если страница уже перезагружена
    localStorage.removeItem('reloaded');
}

const categoryName = document.title;

// Функция для получения продуктов из базы данных
async function fetchProducts() {
    try {
        const response = await fetch('../php/product-page.php?category=' + encodeURIComponent(categoryName));
        
        if (!response.ok) {
            throw new Error('Ошибка: Не удалось получить данные о продуктах.');
        }
        return await response.json();
    } catch (error) {
        console.error('Ошибка при получении данных о продуктах:', error);
    }
}

// Функция для получения URL продуктов
async function fetchProductUrls() {
    try {
        const response = await fetch('../php/product-page.php?urls=true');
        
        if (!response.ok) {
            throw new Error('Ошибка: Не удалось получить URL.');
        }
        return await response.json();
    } catch (error) {
        console.error('Ошибка при получении URL:', error);
    }
}

// Основная функция для загрузки продуктов и отображения их на странице
async function loadProducts() {
    const productsDiv = document.getElementById('products');
    const products = await fetchProducts();
    const urlData = await fetchProductUrls();

    if (products && products.length > 0) {
        products.forEach(product => {
            const productUrl = urlData.find(url => url.original_name === product.name);
            const imagePaths = product.image_paths.split(',');
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                <a href="${productUrl ? productUrl.url : '#'}" target="_blank">
                    <img src="${imagePaths[0]}" alt="${product.name}">
                </a>
                <div class="product-info">
                    <div class="name">
                        <h2 class="product-name">${product.name}</h2>
                    </div>
                    <div class="price-buy">
                        <p class="product-price">${product.main_price} &#8381;</p>
                        <button class="buy-button">Купить</button>
                    </div>
                </div>
            `;
            productsDiv.appendChild(productCard);
        });
    } else {
        productsDiv.innerHTML = '<p>Товары не найдены.</p>';
    }
}
loadProducts();