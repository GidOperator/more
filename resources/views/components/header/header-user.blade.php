    @props(['user' => auth()->user()])

    <livewire:city.header-city-selector />

    @guest
        <button class="btn --white" x-data @click="$dispatch('show-register-modal')">
            Войти
        </button>
    @endguest

    @auth

        <div class="user-special">
            <a href="#" class="user-message"><i class="icon-email"></i> <span class="count">1</span></a>
            <a href="#" class="user-alert"><i class="icon-notifications"></i> <span class="count">99+</span></a>
        </div>

        <div class="user">
            <div class="user__image">
                @if ($user?->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Аватар пользователя">
                @else
                    <span class="user__icon icon-profile"></span>
                @endif
            </div>
            <div class="user__info-wrap">
                <div class="user__name">UserName <span class="icon-chevrondown"></span></div>
                <div class="user__discr">Участник</div>
                <a href="#" role="button" tabindex="0" class="user-menu-toggle"></a>
            </div>
            <div id="userMenu" class="user__menu-wrap">
                <livewire:cabinet.cabinet-switcher />

                <ul class="user__menu">

                    <li>
                        <a href="{{ route('logout') }}" class="user__logout simple-dropdown__link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon-logout simple-dropdown__link-icon"></span> <span>Выйти</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>
    @endauth
