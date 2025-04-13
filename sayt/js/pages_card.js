function toggleVisibility(id, element) {
    const contentElement = document.getElementById(id);
    
    if (contentElement.classList.contains('hidden')) {
        contentElement.classList.remove('hidden'); // Убираем класс hidden
        contentElement.classList.add('slide-down'); // Добавляем класс для анимации

        const scrollHeight = contentElement.scrollHeight; // Получаем высоту содержимого
        contentElement.style.maxHeight = scrollHeight + 'px'; // Устанавливаем max-height

        contentElement.classList.add('show'); // После задержки добавляем класс show
        element.querySelector('.arrow').classList.add('rotate'); // Поворачиваем изображение
    } else {
        contentElement.classList.remove('show'); // Убираем класс show

        contentElement.style.maxHeight = contentElement.scrollHeight + 'px'; 

        contentElement.style.maxHeight = 0; // Устанавливаем max-height обратно в 0

        setTimeout(() => {
            contentElement.classList.add('hidden'); // После задержки добавляем класс hidden
        }, 300); // Задержка равная времени анимации
        element.querySelector('.arrow').classList.remove('rotate'); // Возвращаем изображение в исходное положение
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const buyButton = document.getElementById('buy');

    buyButton.addEventListener('click', function() {
        buyButton.classList.add('clicked');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const buyButton = document.getElementById('buy');

    buyButton.addEventListener('click', function() {
        const productName = document.getElementById('product-name').innerText;
        const productPrice = document.getElementById('product-price').innerText.replace(' руб.', ''); // Убираем " руб."
        const productImage = document.getElementById('product-image').src;

        const product = {
            name: productName,
            price: productPrice,
            image: productImage
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart.push(product);

        localStorage.setItem('cart', JSON.stringify(cart));

        alert(`${productName} добавлен в корзину!`);
    });
});

fetch('databases/db.php')
.then(response => response.json())
.then(data => {
    const images = data.images;
    const currentImage = document.getElementById('currentImage');
    const thumbnailContainer = document.getElementById('thumbnailContainer');

    currentImage.src = images[0];

    images.forEach(imageSrc => {
        const img = document.createElement('img');
        img.src = imageSrc;
        img.alt = "Миниатюра";
        img.className = "thumbnail";
        img.onclick = () => setCurrentImage(imageSrc);
        thumbnailContainer.appendChild(img);
    });
})
.catch(error => console.error('Ошибка при загрузке изображений:', error));

function setCurrentImage(imageSrc) {
    const currentImage = document.getElementById('currentImage');
    currentImage.src = imageSrc; // Обновляем источник большого изображения
}