<div class="t450__menu__content" data-menu="yes">
    <div class="t450__burger_container t450__small ">
        <div class="t450__burger_bg t450__burger_cirqle" style="background-color:#bdb9b9; opacity:0.70;"></div>
        <button type="button" class="t-menuburger t-menuburger_first t-menuburger__small" aria-label="Навигационное меню" aria-expanded="false">
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        </button>
        <script>
            function t_menuburger_init(recid) {
                var rec = document.querySelector('#rec' + recid);
                if (!rec) return;
                var burger = rec.querySelector('.t-menuburger');
                if (!burger) return;
                var isSecondStyle = burger.classList.contains('t-menuburger_second');
                if (isSecondStyle && !window.isMobile && !('ontouchend' in document)) {
                    burger.addEventListener('mouseenter', function() {
                        if (burger.classList.contains('t-menuburger-opened')) return;
                        burger.classList.remove('t-menuburger-unhovered');
                        burger.classList.add('t-menuburger-hovered');
                    });
                    burger.addEventListener('mouseleave', function() {
                        if (burger.classList.contains('t-menuburger-opened')) return;
                        burger.classList.remove('t-menuburger-hovered');
                        burger.classList.add('t-menuburger-unhovered');
                        setTimeout(function() {
                            burger.classList.remove('t-menuburger-unhovered');
                        }, 300);
                    });
                }
                burger.addEventListener('click', function() {
                    if (!burger.closest('.tmenu-mobile') &&
                        !burger.closest('.t450__burger_container') &&
                        !burger.closest('.t466__container') &&
                        !burger.closest('.t204__burger') &&
                        !burger.closest('.t199__js__menu-toggler')) {
                        burger.classList.toggle('t-menuburger-opened');
                        burger.classList.remove('t-menuburger-unhovered');
                    }
                });
                var menu = rec.querySelector('[data-menu="yes"]');
                if (!menu) return;
                var menuLinks = menu.querySelectorAll('.t-menu__link-item');
                var submenuClassList = ['t978__menu-link_hook', 't978__tm-link', 't966__tm-link', 't794__tm-link', 't-menusub__target-link'];
                Array.prototype.forEach.call(menuLinks, function(link) {
                    link.addEventListener('click', function() {
                        var isSubmenuHook = submenuClassList.some(function(submenuClass) {
                            return link.classList.contains(submenuClass);
                        });
                        if (isSubmenuHook) return;
                        burger.classList.remove('t-menuburger-opened');
                    });
                });
                menu.addEventListener('clickedAnchorInTooltipMenu', function() {
                    burger.classList.remove('t-menuburger-opened');
                });
            }
        </script>
        <style>
            .t450_burger_container {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 1000;
            }
                    
            .t-menuburger {
                min-width: 30px;
                height: 30px;
                border: none;
                background-color: transparent;
                outline: none;
                transition: transform 0.5s ease-in-out;
                cursor: pointer;
            }
                    
            .t450__menu__content { 
                width: 30px;
                height: 30px;
                position: absolute;
                top: 4px;
                right: 20px;
                z-index: 1000; /* Убедитесь, что меню поверх других элементов */
            }
          
            .burger-line {
                display: block; /* Убедитесь, что полоски отображаются как блочные элементы */
                width: 100%; /* Ширина полосок равна ширине кнопки */
                height: 2px; /* Высота полосок */
                background-color: #555; /* Темный серый цвет */
                margin: 4px 0; /* Отступы между полосками */
                transition: all 0.3s ease;
                border-radius: 6px;
            }
          
            .t-menuburger:hover .burger-line:nth-child(1) {
                transform: translateY(2px); /* Опускаем верхнюю линию вниз */
            }
          
            .t-menuburger:hover .burger-line:nth-child(3) {
                transform: translateY(-2px); /* Поднимаем нижнюю линию вверх */
            }
                    
            @media (max-width: 960px) {
                .t-menuburger {
                    top: 20px;
                    transform: none;
                }
            }
                              
            * {
                box-sizing: border-box; 
            }
        </style>
  </div>
</div>