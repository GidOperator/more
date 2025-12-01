<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Море Событий' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Свои стили -->
    <link rel="stylesheet" href="{{ asset('events-2.loc/css/slyle.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__top">
            <div class="header__top-inner container">
                <div class="header__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Море Событий">
                    </a>
                </div>
                <div class="header__last-event">
                    <div class="header__event-heading">Фестиваль в Парке Культуры</div>
                    <div class="header__event-start">
                        <span class="header__discr">начнётся через</span>
                        <span class="header__time">22:48:15</span>
                    </div>
                </div>
                <div class="header__user-box">
                    <div class="user-special">
                        <a href="#" class="user-message">
                            <i class="icon-email"></i> <span class="count">1</span>
                        </a>
                        <a href="#" class="user-alert">
                            <i class="icon-notifications"></i> <span class="count">99+</span>
                        </a>
                    </div>
                    <div class="user">
                        <div class="user__image">
                            <a href="#"><img src="{{ asset('images/avatar.jpg') }}" alt=""></a>
                        </div>
                        <div class="user__info-wrap">
                            <a href="#" class="user__name">Василиса Кошечкина <i class="icon-chevrondown"></i></a>
                            <div class="user__discr">Администратор Алёна Б., Фотосъёмка</div>
                        </div>
                        <a href="#" class="user__logout"><i class="icon-logout"></i></a>
                    </div>
                </div>
                <div class="header__login">
                    <button class="btn">Войти / зарегистрироваться</button>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="header__bottom-inner container">
                <nav class="top-menu-wrap">
                    <ul class="top-menu">
                        <li class="top-menu__item"><a class="top-menu__link --active" href="#">События</a></li>
                        <li class="top-menu__item"><a class="top-menu__link" href="#">Организаторы</a></li>
                        <li class="top-menu__item"><a class="top-menu__link" href="#">Локации</a></li>
                        <li class="top-menu__item"><a class="top-menu__link" href="#">Партнёры</a></li>
                        <li class="top-menu__item"><a class="top-menu__link" href="#">Услуги</a></li>
                        <li class="top-menu__item"><a class="top-menu__link" href="#">Медиа контент</a></li>
                    </ul>
                </nav>
                <div class="search">
                    <form class="search-form" action="#" method="GET">
                        <div class="search-form__fields">
                            <input class="form-control search-form__input" type="text" name="query"
                                placeholder="Поиск" required>
                            <button class="search-form__submit" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__inner container">
            <div class="footer__col">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo-blue.svg') }}" alt="Море Событий">
                </div>
                <div class="footer__info">
                    <span>Место для юридической информации: ИНН / ОГРН, фактический адрес, юридический адрес, все
                        необходимые реквизиты</span>
                    <span class="copyrights">Все права защищены. Копирование материалов сайта без ссылки на источник
                        запрещено.</span>
                </div>
                <div class="footer__socials">
                    <div class="socials">
                        <a href="#" class="social-link --vk"><i class="icon-vk"></i></a>
                        <a href="#" class="social-link --tg"><i class="icon-tg"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer__col --menu">
                <ul class="footer__menu">
                    <li class="footer__menu-item"><a class="footer__menu-link --active" href="#">События</a>
                    </li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Организаторы</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Локации</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Партнёры</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Услуги</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Медиа контент</a></li>
                </ul>
                <ul class="footer__menu">
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Политика
                            конфиденциальности</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Правила сервиса</a>
                    </li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Обработка персональных
                            данных</a></li>
                    <li class="footer__menu-item"><a class="footer__menu-link" href="#">Техническая
                            поддержка</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
