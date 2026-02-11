document.addEventListener('DOMContentLoaded', () => {
    // Проверка ширины экрана
    const isDesktop = () => window.innerWidth > 992;

    // Инициализация выпадающих меню
    const initDropdowns = () => {
        // Работаем только на десктопных экранах
        if (!isDesktop()) return;

        // Находим все элементы .wrapper-dropdown
        document.querySelectorAll('.wrapper-dropdown').forEach(dropdown => {
            // Находим все ссылки внутри текущего меню
            const links = dropdown.querySelectorAll('.wrapper-dropdown a');

            // Добавляем обработчик клика для каждой ссылки
            links.forEach(link => {
                link.addEventListener('click', (e) => {
                    // Добавляем класс только к текущему контейнеру
                    dropdown.classList.add('no-hover');

                    // Плавная прокрутка к якорю
                    const targetId = link.getAttribute('href');
                    if (targetId && targetId.startsWith('#')) {
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            window.scrollTo({
                                top: targetElement.offsetTop - 20,
                                behavior: 'smooth'
                            });

                            // Восстанавливаем возможность ховера после прокрутки
                            setTimeout(() => {
                                if (isDesktop()) {
                                    dropdown.classList.remove('no-hover');
                                }
                            }, 800);
                        }
                    }
                });
            });

            // Удаляем класс при уходе курсора с контейнера
            dropdown.addEventListener('mouseleave', () => {
                if (isDesktop()) {
                    dropdown.classList.remove('no-hover');
                }
            });
        });
    };

    // Инициализация при загрузке
    initDropdowns();

    // Обработчик изменения размера окна
    window.addEventListener('resize', () => {
        // Если перешли на мобильное разрешение, очищаем состояние всех меню
        if (!isDesktop()) {
            document.querySelectorAll('.wrapper-dropdown').forEach(dropdown => {
                dropdown.classList.remove('no-hover');
            });
        }
        // Повторная инициализация (актуально при переходе с мобильного на десктоп)
        initDropdowns();
    });
});

//Offcanvas menu open close
document.querySelector('.offcanvas-toggler')?.addEventListener('click', () => {
    document.body.classList.add('offcanvas-show');
});

document.querySelector('.offcanvas-close')?.addEventListener('click', () => {
    document.body.classList.remove('offcanvas-show');
});
// Sub menus
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('level-1')) {
            const parentCol = e.target.closest('.top-menu__item');
            if (parentCol) {
                parentCol.classList.toggle('--open');
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('level-2')) {
            const parentCol = e.target.closest('.mega-menu__col');
            if (parentCol) {
                parentCol.classList.toggle('--open');
            }
        }
    });
});
//
document.querySelector('.top-menu-wrap').addEventListener('click', function (e) {
    if (e.target.tagName === 'A') {
        document.body.classList.remove('offcanvas-show');
    }
});