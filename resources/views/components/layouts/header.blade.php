 <header class="header">
     <div class="header__top">
         <div class="header__top-inner container">
             <div class="header__logo">
                 <button class="offcanvas-toggler d-flex d-lg-none"><span class="icon-menu"></span></button>
                 <a href="{{ url('/') }}">
                     <img src="{{ asset('images/logo.svg') }}" alt="Море Событий">
                 </a>
             </div>
             <div class="header__user-box">
                 @include('components.header.header-user')
             </div>

         </div>
     </div>
     <div class="header__bottom">
         <div class="header__bottom-inner container">
             <div class="offcanvas-overlay d-lg-none"></div>
             <nav class="top-menu-wrap">
                 <div class="offcanvas-top-box d-lg-none">
                     <div class="top-box-buttons">
                         <button class="top-box__btn offcanvas-close icon-close"></button>
                     </div>
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
                 <ul class="top-menu">
                     <li class="top-menu__item has-child mobile-relative">
                         <div class="menu-link-wrap">
                             <button class="icon-chevron-dwn menu-toggle level-1 d-lg-none"></button>
                             <a class="top-menu__link" href="#">
                                 <span class="menu-icon icon-event d-lg-none"></span>
                                 События
                             </a>
                         </div>
                         <div class="mega-menu-wrapper wrapper-dropdown">
                             <livewire:catalog.catalog-dropdown />
                         </div>
                     </li>
                     <li class="top-menu__item">
                         <a class="top-menu__link" href="#">
                             <span class="menu-icon icon-org d-lg-none"></span>
                             Организаторы
                         </a>
                     </li>
                     <li class="top-menu__item has-child --relative">
                         <div class="menu-link-wrap">
                             <button class="icon-chevron-dwn menu-toggle level-1 d-lg-none"></button>
                             <a class="top-menu__link" href="#">
                                 <span class="menu-icon icon-geo d-lg-none"></span>
                                 Локации
                             </a>
                         </div>
                         <div class="simple-dropdown-wrap wrapper-dropdown">
                             <livewire:location.location-dropdown />
                         </div>
                     </li>
                     <li class="top-menu__item">
                         <a class="top-menu__link" href="#">
                             <span class="menu-icon icon-partner d-lg-none"></span>
                             Партнёры
                         </a>
                     </li>
                     <li class="top-menu__item has-child --relative">
                         <div class="menu-link-wrap">
                             <button class="icon-chevron-dwn menu-toggle level-1 d-lg-none"></button>
                             <a class="top-menu__link" href="#">
                                 <span class="menu-icon icon-partnership d-lg-none"></span>
                                 Услуги
                             </a>
                         </div>
                         <div class="simple-dropdown-wrap wrapper-dropdown">
                             <livewire:services.services-dropdown />
                         </div>
                     </li>
                     <li class="top-menu__item">
                         <a class="top-menu__link" href="#">
                             <span class="menu-icon icon-photo d-lg-none"></span>
                             Медиа контент
                         </a>
                     </li>
                 </ul>
             </nav>
             <div class="search d-none d-lg-block">
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