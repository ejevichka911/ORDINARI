<style>
    .list-bottom {
        width: 100%;
        height: 100%; 
    }
            
    .list_bottom-fav {
        width: 100%;
        height: 60px;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .list-bottom-log {
        width: 100%;
        height: 60px;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .log-container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
  
    .empty-cart-message {
        text-align: center; /* Центрируем текст */
        width: 100%; /* Занимает всю ширину контейнера */
        margin: 20px 0; /* Отступы сверху и снизу */
    }

    #log-form {
        width: 300px;
    }

    .input-field {
        width: 100%; /* Поля занимают всю ширину контейнера */
        padding: 10px; /* Отступы внутри полей */
        margin-bottom: 20px; /* Отступ между полями и кнопкой */
        border: 1px solid #ccc; /* Цвет рамки */
        border-radius: 4px; /* Закругленные углы */
        font-size: 16px; /* Размер шрифта */
    }

    .button-container {
        width: 100%; /* Ширина контейнера для кнопки */
        display: flex; /* Используем flexbox для центрирования */
        justify-content: center; /* Центрируем кнопку по горизонтали */
    }

    .submit-button {
        padding: 10px 20px; /* Отступы внутри кнопки */
        background-color: #4CAF50; /* Цвет фона кнопки */
        color: white; /* Цвет текста кнопки */
        border: none; /* Убираем рамку */
        border-radius: 4px; /* Закругленные углы */
        cursor: pointer; /* Курсор указателя */
        font-size: 16px; /* Размер шрифта */
        transition: background-color 0.3s; /* Плавный переход цвета фона */
    }

    .submit-button:hover {
        background-color: #45a049; /* Цвет фона при наведении */
    }

    .register-link {
        color: blue; /* Синий цвет текста */
        text-decoration: none; /* Убираем подчеркивание */
        font-size: 16px; /* Размер шрифта */
        margin-top: 10px; /* Отступ сверху */
        display: inline-block; /* Чтобы отобразить отступы */
    }

    .input-field {
        width: 100%; /* Поля занимают всю ширину контейнера */
        padding: 10px; /* Отступы внутри полей */
        margin-bottom: 20px; /* Отступ между полями и кнопкой */
        border: 1px solid #ccc; /* Цвет рамки */
        border-radius: 4px; /* Закругленные углы */
        font-size: 16px; /* Размер шрифта */
    }

    .button-container {
        width: 100%; /* Ширина контейнера для кнопки */
        display: flex; /* Используем flexbox для центрирования */
        justify-content: center; /* Центрируем кнопку по горизонтали */
    }

    .submit-button {
        padding: 10px 20px; /* Отступы внутри кнопки */
        background-color: #4CAF50; /* Цвет фона кнопки */
        color: white; /* Цвет текста кнопки */
        border: none; /* Убираем рамку */
        border-radius: 4px; /* Закругленные углы */
        cursor: pointer; /* Курсор указателя */
        font-size: 16px; /* Размер шрифта */
        transition: background-color 0.3s; /* Плавный переход цвета фона */
    }

    .submit-button:hover {
        background-color: #45a049; /* Цвет фона при наведении */
    }

    .login-container {
        margin-top: 10px; /* Отступ сверху для контейнера */
    }

    .login-link {
        color: blue; /* Синий цвет текста */
        text-decoration: none; /* Убираем подчеркивание */
        font-size: 16px; /* Размер шрифта */
        display: inline-block; /* Чтобы отобразить отступы */
        cursor: pointer; /* Курсор указателя */
    }

    .login-link:hover {
        text-decoration: underline; /* Подчеркивание при наведении */
    }
  
    .password-message {
        font-size: 14px;
        margin-top: 5px;
    }
</style>
<div id="sidebar" class="sidebar">
    <div class="sidebar-top">
        <button id="search" class="sidebar-button-top">
            <img src="https://ordinari.ru/assets/img/Lypa1.png" alt="Lypa" style="width: 25px; height: 25px;">
        </button>
        <button id="favourites" class="sidebar-button-top">
            <img src="https://ordinari.ru/assets/img/Heart.png" alt="Favorite" style="width: 25px; height: 25px;">
        </button>
        <button id="login" class="sidebar-button-top">
            <img src="https://ordinari.ru/assets/img/Guest1.png" alt="Guest" style="width: 25px; height: 25px;">
        </button>
        <button id="close-sidebar" class="close-button">
            <img src="https://ordinari.ru/assets/img/close.png" alt="Закрыть" style="width: 20px; height: 20px;">
        </button>
    </div>
    <div class="divider"></div>
    <div class="sidebar-bottom">
        <button class="sidebar-button-bottom" onclick="window.location.href='https://ordinari.ru/'">Главная</button>
        <div class="divider"></div>
        <button class="sidebar-button-bottom" onclick="window.location.href='https://ordinari.ru/catalog.php'">Каталог</button>
        <div class="divider"></div>
        <button id="basket" class="sidebar-button-bottom">Корзина</button>
        <div class="divider"></div>
        <button class="sidebar-button-bottom">Мои заказы</button>
        <div class="divider"></div>
        <button class="sidebar-button-bottom">Отслеживание заказов</button>
        <div class="divider"></div>
        <button class="sidebar-button-bottom">Оплата и доставка</button>
        <div class="divider"></div>
        <div class="sidebar-bottom-text-a">Время работы</div>
        <div class="sidebar-bottom-text">ПН - ПТ : 10:00 - 19:00</div>
        <div class="sidebar-bottom-text">СБ - ВС : Выходные</div>
        <div class="divider"></div>
        <div class="sidebar-bottom-text-a">Контакты</div>
        <div class="sidebar-bottom-text">8 926 919-62-95  |  orden1@bk.ru</div>
        <div class="sidebar-bottom-text">г. Москва ул. Буракова 27</div>
        <div class="divider"></div>
        <button id="admin-panel" class="sidebar-button-bottom" style="display: none;">Панель администратора</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerButton = document.querySelector('.t-menuburger');
        const sidebar = document.getElementById('sidebar');
        const closeSidebarButton = document.getElementById('close-sidebar');
        const darkOverlay = document.getElementById('darkOverlay');
        const sidebarBottom = document.querySelector('.sidebar-bottom');
        const originalContent = sidebarBottom.innerHTML;
        const favouriteButton = document.getElementById('favourites');
        const loginButton = document.getElementById('login');
        const cartButton = document.getElementById('basket');
        const cartItems = <?php echo json_encode($cartItems); ?>;
  
        let isFavouritesVisible = false;
        let isLoginVisible = false;
        let isCartVisible = false;
        let isCartOpen = false;
      
        let isSearchVisible = false;
        let isAdminPanelVisible = false;
  
        function updateSidebarContent() {
            sidebarBottom.innerHTML = originalContent;
        }

        // Обработчик для кнопки закрытия боковой панели
        closeSidebarButton.addEventListener('click', () => {
            updateSidebarContent();
            sidebar.classList.remove('open'); // Закрытие меню
            darkOverlay.style.display = 'none'; // Скрытие оверлея
            resetStates();
        });

        // Обработчик для кнопки бургер-меню
        burgerButton.addEventListener('click', () => {
            sidebar.classList.toggle('open'); // Переключение класса для открытия/закрытия
            darkOverlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none'; // Показать/скрыть оверлей
        });

        // Закрытие меню при клике на оверлей
        darkOverlay.addEventListener('click', () => {
            sidebar.classList.remove('open'); // Закрытие меню
            darkOverlay.style.display = 'none'; // Скрытие оверлея
            resetStates();
        });
      
        function resetStates() {
            isFavouritesVisible = false;
            isLoginVisible = false;
            isCartVisible = false;
        }
      
        favouriteButton.addEventListener('click', () => {
            if (isFavouritesVisible) {
                updateSidebarContent();
            } else {
                sidebarBottom.innerHTML = `
                    <div class="list-bottom">
                        <div class="list_bottom-fav">
                            <h1 class="list-favorite-name">Список избранного</h1>
                        </div>
                        <div class="divider"></div>
                        <div class="list-favorite"></div>
                    </div>
                `;
            }
            isFavouritesVisible = !isFavouritesVisible;
            isLoginVisible = false; // Скрываем вход/регистрацию
            isCartVisible = false;
        });
      
        loginButton.addEventListener('click', () => {
            if (isLoginVisible) {
                updateSidebarContent();
            } else {
                sidebarBottom.innerHTML = `
                    <div class="list-bottom">
                        <div class="list-bottom-log">
                            <h1>Вход / Регистрация</h1>
                        </div>
                        <div class="divider"></div>
                        <div class="log-container">
                            <form id="log-form" action="#" method="post">
                                <input type="text" id="login-input" class="input-field" placeholder="Введите вашу почту или телефон" required>
                                <div id="password-container" style="display: none;">
                                    <input type="password" id="password-input" class="input-field" placeholder="Введите пароль" required>
                                </div>
                                <div class="button-container">
                                    <input type="submit" class="submit-button" value="Войти">
                                </div>
                            </form>
                            <div class="register-container">
                                <a href="#" class="register-link">Регистрация</a>
                            </div>
                        </div>
                    </div>
                `;
            }
            isLoginVisible = !isLoginVisible;
            isFavouritesVisible = false;
            isCartVisible = false;
      
            // Обработчик для отправки запроса на сервер
            const loginInput = document.getElementById('login-input');
            const passwordContainer = document.getElementById('password-container');

            loginInput.addEventListener('input', () => {
                const inputValue = loginInput.value;

                // Отправляем запрос на сервер для проверки
                fetch('databases/check_credentials.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'login=' + encodeURIComponent(inputValue)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        passwordContainer.style.display = 'block'; // Показываем поле для пароля
                    } else {
                        passwordContainer.style.display = 'none'; // Скрываем поле для пароля
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
            });

            // Обработчик для кнопки регистрации
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('register-link')) {
                    sidebarBottom.innerHTML = `
                        <div class="list-bottom">
                            <div class="list-bottom-log">
                                <h1>Вход / Регистрация</h1>
                            </div>
                            <div class="divider"></div>
                            <div class="log-container">
                                <form id="reg-form" action="#" method="post">
                                    <input type="text" class="input-field" placeholder="Введите вашу почту" required>
                                    <input type="password" class="input-field" id="password" placeholder="Введите пароль" required>
                                    <input type="password" class="input-field" id="confirm-password" placeholder="Подтвердите пароль" required>
                                    <div class="password-message"></div>
                                    <div class="button-container">
                                        <input type="submit" class="submit-button" id="register-button" value="Зарегистрироваться">
                                    </div>
                                </form>
                                <div class="login-container">
                                    <a href="#" class="login-link">Войти</a>
                                </div>
                            </div>
                        </div>
                    `; 

                    // Добавляем обработчик события на форму
                    const regForm = document.getElementById('reg-form');
                    regForm.addEventListener('submit', (e) => {
                        e.preventDefault(); // Предотвращаем отправку формы

                        const password = document.getElementById('password').value;
                        const confirmPassword = document.getElementById('confirm-password').value;
                        const passwordMessage = document.querySelector('.password-message');

                        if (password !== confirmPassword) {
                            passwordMessage.textContent = 'Пароли не совпадают. Пожалуйста, попробуйте снова.';
                            passwordMessage.style.color = 'red'; // Устанавливаем цвет сообщения об ошибке
                        } else {
                            passwordMessage.textContent = ''; // Очищаем сообщение об ошибке
                            // Здесь можно добавить логику для отправки формы, например, AJAX-запрос
                            console.log('Форма отправлена'); // Замените это на вашу логику отправки
                        }
                    });
                }
            
                // Обработчик для кнопки "Войти" в форме регистрации
                if (event.target.classList.contains('login-link')) {
                    sidebarBottom.innerHTML = `
                        <div class="list-bottom">
                            <div class="list-bottom-log">
                                <h1>Вход / Регистрация</h1>
                            </div>
                            <div class="divider"></div>
                            <div class="log-container">
                                <form id="log-form" action="#" method="post">
                                    <input type="text" class="input-field" placeholder="Введите вашу почту или телефон" required>
                                    <div class="button-container">
                                        <input type="submit" class="submit-button" value="Войти">
                                    </div>
                                </form>
                                <div class="register-container">
                                    <a href="#" class="register-link">Регистрация</a>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });
        });

       cartButton.addEventListener('click', () => {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];  

            let cartContent = `
                <div class="list-bottom">
                    <div class="list-bottom-log">
                        <h1>Корзина</h1>
                    </div>
                    <div class="divider"></div>
                    <div class="log-container" style="justify-content: flex-start;">
            `;

            if (cartItems.length === 0) {
                cartContent += `<p class="empty-cart-message">Корзина пуста.</p>`;
            } else {
                cartItems.forEach((item, index) => {
                    cartContent += `
                        <div class="cart-item">
                            <img src="${item.image}" alt="${item.name}">
                            <p>${item.name}</p>
                            <p>${item.price} руб.</p>
                            <button class="remove-button" data-index="${index}">Удалить</button>
                        </div>
                        <div class="divider"></div>
                    `;
                });
            }

            cartContent += `
                    </div>
                </div>
            `;

            sidebarBottom.innerHTML = cartContent; // Обновляем содержимое боковой панели

            // Добавляем обработчики событий для кнопок удаления
            addRemoveButtonListeners();
            isCartVisible = !isCartVisible;
            isFavouritesVisible = false; // Скрываем избранное
            isLoginVisible = false; // Скрываем вход/регистрацию
        });

        function addRemoveButtonListeners() {
            const removeButtons = document.querySelectorAll('.remove-button');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    cartItems.splice(index, 1); // Удаляем товар из массива
                    localStorage.setItem('cart', JSON.stringify(cartItems)); // Обновляем Local Storage
                    cartButton.click(); // Обновляем отображение корзины
                });
            });
        }
              
                  
                  
                  
                  
                  
                  
        const searchButton = document.getElementById('search');

searchButton.addEventListener('click', () => {
    if (isAdminPanelVisible) {
        updateSidebarContent();
    } else {
        sidebarBottom.innerHTML = `
            <div class="list-bottom">
                <div class="list-bottom-log">
                    <h1>Панель администратора</h1>
                </div>
                <div class="divider"></div>
                <div class="log-container" style="align-items: flex-start; justify-content: flex-start;">
                    <button class="sidebar-button-bottom" onclick="window.location.href='https://ordinari.ru/'">Главная</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom" onclick="window.location.href='https://ordinari.ru/catalog.php'">Каталог</button>
                    <div class="divider"></div>
                    <button id="basket" class="sidebar-button-bottom">Корзина</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom">Оплата и доставка</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom">Управление товарами</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom">Управление заказами</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom">Управление клиентами</button>
                    <div class="divider"></div>
                    <button class="sidebar-button-bottom">Метрика</button>
                    <div class="divider"></div>
                    <div class="sidebar-bottom-text-a">Время работы</div>
                    <div class="sidebar-bottom-text">ПН - ПТ : 10:00 - 19:00</div>
                    <div class="sidebar-bottom-text">СБ - ВС : Выходные</div>
                    <div class="divider"></div>
                    <div class="sidebar-bottom-text-a">Контакты</div>
                    <div class="sidebar-bottom-text">8 926 919-62-95  |  orden1@bk.ru</div>
                    <div class="sidebar-bottom-text">г. Москва ул. Буракова 27</div>
                    <div class="divider"></div>
                </div>
            </div>
        `;
    }
    isAdminPanelVisible = !isAdminPanelVisible;
    isFavouritesVisible = false; // Скрываем избранное
    isLoginVisible = false; // Скрываем вход/регистрацию
});
                      
    });
</script>
<style>
    .sidebar-bottom-text-a {
        font-size: 20px; 
        padding: 10px 0px;
    }
        
    .sidebar-bottom-text {
        padding: 5px 0px;
        font-size: 20px; 
    }
        
    .divider {
        width: 100%; /* Ширина полосок равна ширине кнопки */
        height: 1px; /* Высота полосок */
        background-color: #555; /* Темный серый цвет */
        border-radius: 6px;
        margin: 3px 0;
    }
        
    .sidebar-top {
        padding: 20px;
        width: 100%;
        flex: 0 0 8%; /* Верхняя часть занимает 30% высоты */
        display: flex;
        justify-content: flex-end;
        align-items: center; /* Выровнять кнопки по правому краю */
    }
        
    .sidebar-bottom {
        padding: 0px 20px 20px 20px;
        width: 100%;
        flex: 1; /* Нижняя часть занимает оставшееся пространство */
        display: flex;
        flex-direction: column; /* Вертикальное расположение кнопок */
        align-items: flex-start; /* Выровнять кнопки по правому краю */
    }
        
    .sidebar {
        position: fixed;
        top: 0;
        right: -45%; /* Скрыто за пределами экрана */
        width: 45%;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        transition: right 0.3s ease; /* Плавный переход */
        z-index: 1000;
        display: flex;
        flex-direction: column; /* Вертикальное расположение кнопок */
        align-items: flex-end; /* Выровнять кнопки по правому краю */
        box-sizing: border-box; /* Учитывать отступы и границы в ширине и высоте */
    }

    .sidebar.open {
        right: 0; /* Показать меню */
    }

    .close-button {
        background: none;
        border: none;
        font-size: 25px;
        cursor: pointer;
        position: absolute;
        left: 20px;
    }
        
    .sidebar-button-top {
        margin-right: 10px;
        display: block; /* Показать кнопки в боковой панели */
        font-size: 20px; /* Размер шрифта для кнопок */
        cursor: pointer; /* Курсор указателя */
        background-color: transparent; /* Фон кнопок */
        border: none; /* Убрать рамку */
        color: #000; /* Цвет текста кнопок */
        text-align: right; /* Выровнять текст по правому краю */
    }

    .sidebar-button-bottom {
        font-size: 20px; /* Размер шрифта для кнопок */
        font-weight: normal;
        transition: font-size 0.3s ease, font-weight 0.3s ease;
        padding: 20px 0px;
        cursor: pointer; /* Курсор указателя */
        background-color: transparent; /* Фон кнопок */
        border: none; /* Убрать рамку */
        color: #000; /* Цвет текста кнопок */
        text-align: right; /* Выровнять текст по правому краю */
    }
        
    .sidebar-button-bottom:hover {
        transform: scale(1.05);
        font-weight: bold;
    }
        
    .dark-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Полупрозрачный черный фон */
        display: none; /* Скрыто по умолчанию */
        z-index: 900; /* Под меню, но над остальным контентом */
    }

    .sb-background-image {
        width: 100%; /* Ширина контейнера 100% */
        aspect-ratio: 16/9;
        position: relative; /* Для позиционирования вложенных элементов */
        overflow: hidden; /* Скрываем переполнение */
    }

    .responsive-image {
        width: 100%; /* Изображение занимает всю ширину контейнера */
        height: 100%; /* Высота 100% от родительского контейнера */
        object-fit: cover; /* Масштабируем изображение, сохраняя пропорции */
        display: block; /* Убирает пробелы под изображением */
    }
        
    @media (max-width: 500px) {
        .sidebar {
            width: 100%;
            right: -100%;
        }
          
        .close-button {
            left: 15px;
            font-size: 20px;
        }
    }
  
    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 10px 0;
    }

    .cart-item img {
        width: 100px;
        height: auto;
        margin-right: 10px;
    }

    .remove-button {
        margin-left: 10px;
        cursor: pointer;
        background-color: #f44336; /* Красный цвет для кнопки удаления */
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .remove-button:hover {
        background-color: #d32f2f; /* Темнее при наведении */
    }
</style>