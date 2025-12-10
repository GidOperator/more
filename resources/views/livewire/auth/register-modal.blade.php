<div>
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1"
        @if ($showModal) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered reg-modal">
            <div class="modal-content rounded-4 shadow">

                {{-- Заголовок --}}
                <div class="modal-header">
                    @if ($mode !== 'verify')
                        <div class="reg-btns-wrap">
                            <button class="reg-form-btn @if ($mode === 'login') active @endif"
                                wire:click="$set('mode','login')">Вход</button>
                            <button class="reg-form-btn me-2 @if ($mode === 'input') active @endif"
                                wire:click="$set('mode','input')">Регистрация</button>
                        </div>
                    @endif
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>

                <div class="modal-body">

                    {{-- Вход --}}
                    @if ($mode === 'login')
                        {{-- Добавляем Alpine.js для управления маской и паролем --}}
                        <form wire:submit.prevent="login" x-data="{
                            showPassword: false,
                            loginPhone: @entangle('loginPhone'),
                            loginPassword: @entangle('loginPassword')
                        }" class="d-flex flex-column">

                            {{-- Телефон (с x-mask) --}}
                            <div class="mb-2">
                                <input type="text" x-model="loginPhone" x-mask="+7 (999) 999-99-99"
                                    placeholder="+7 (___) ___-__-__" id="loginPhone" class="form-control">
                            </div>

                            {{-- Пароль с глазиком --}}
                            <div class="position-relative mb-2">
                                <input :type="showPassword ? 'text' : 'password'" x-model="loginPassword"
                                    placeholder="Пароль" class="form-control">
                                <button type="button"
                                    class="btn btn-sm position-absolute top-50 end-0 translate-middle-y"
                                    @click="showPassword = !showPassword">
                                    {{-- Используем Font Awesome классы --}}
                                    <i class="fa" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>

                            @error('loginPhone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            @error('loginPassword')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <div class="submit-wrap --row">
                                <button type="submit" class="submit btn --blue">Войти</button>
                                <button type="button" class="link"
                                    wire:click="$dispatch('close-register-modal'); $dispatch('show-forgot-password-modal')">
                                    Забыли пароль?
                                </button>
                            </div>
                        </form>
                    @endif

                    {{-- Регистрация --}}
                    @if ($mode === 'input')
                        {{-- Добавляем Alpine.js для маски и паролей --}}
                        <form wire:submit.prevent="startRegister" class="reg-form" x-data="{
                            showPassword: false,
                            showPasswordConfirm: false,
                            phone: @entangle('phone'),
                            password: @entangle('password'),
                            password_confirmation: @entangle('password_confirmation')
                        }">

                            {{-- Роли --}}
                            <div class="form-group mb-3">
                                <div class="radio-group d-flex flex-column">
                                    @foreach (\App\Models\Role::all() as $r)
                                        {{-- *** ИСПРАВЛЕНИЕ: Добавлен класс radio-input *** --}}
                                        <div class="form-check radio-input mb-2">
                                            <input class="form-check-input" type="radio" id="role_{{ $r->id }}"
                                                value="{{ $r->id }}" wire:model.defer="role">
                                            {{-- *** ИСПРАВЛЕНИЕ: Добавлен div с классом radio-input__button *** --}}
                                            <label class="form-check-label" for="role_{{ $r->id }}">
                                                {{-- Элемент, который ВАШ CSS стилизует как радиокнопку --}}
                                                <div class="radio-input__button"></div>

                                                <span class="fw-bold">{{ $r->name }}</span>
                                                @if ($r->description)
                                                    <span class="text-muted small"
                                                        style="line-height:1.3;">{{ $r->description }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- ВОССТАНОВЛЕННЫЙ БЛОК ПОЛЕЙ --}}
                            <div class="fields-group d-flex flex-column mb-3">
                                {{-- Телефон (с x-mask) --}}
                                <div class="mb-2">
                                    <input type="text" x-model="phone" x-mask="+7 (999) 999-99-99"
                                        placeholder="+7 (___) ___-__-__" id="registerPhone" class="form-control">
                                    @error('phone')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Пароль --}}
                                <div class="position-relative mb-2">
                                    <input x-model="password" :type="showPassword ? 'text' : 'password'"
                                        placeholder="Придумайте пароль" class="form-control">
                                    <button type="button"
                                        class="btn btn-sm position-absolute top-50 end-0 translate-middle-y"
                                        @click="showPassword = !showPassword">
                                        {{-- Используем Font Awesome классы --}}
                                        <i class="fa" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>

                                {{-- Подтверждение пароля --}}
                                <div class="position-relative mb-2">
                                    <input x-model="password_confirmation"
                                        :type="showPasswordConfirm ? 'text' : 'password'" placeholder="Повторите пароль"
                                        class="form-control">
                                    <button type="button"
                                        class="btn btn-sm position-absolute top-50 end-0 translate-middle-y"
                                        @click="showPasswordConfirm = !showPasswordConfirm">
                                        {{-- Используем Font Awesome классы --}}
                                        <i class="fa" :class="showPasswordConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- КОНЕЦ ВОССТАНОВЛЕННОГО БЛОКА ПОЛЕЙ --}}

                            {{-- Политика --}}
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="policyCheck"
                                    wire:model.defer="policyAccepted">
                                <label class="form-check-label small" for="policyCheck">
                                    Я принимаю <a href="/policy" target="_blank">политику обработки персональных
                                        данных</a> и
                                    <a href="/terms" target="_blank">пользовательское соглашение</a>
                                </label>
                                @error('policyAccepted')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Отправка --}}
                            <div class="submit-wrap">
                                <button type="submit" class="submit btn --blue">Зарегистрироваться</button>
                            </div>
                        </form>
                    @endif

                    {{-- Верификация --}}
                    @if ($mode === 'verify')
                        <form wire:submit.prevent="verifyCode" class="d-flex flex-column">
                            <h1>Введите код из SMS</h1>
                            <input wire:model.defer="code" type="text" placeholder="Код из SMS"
                                class="form-control mb-2">
                            @error('code')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            <div class="submit-wrap">
                                <button type="submit" class="submit btn --blue">Подтвердить</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
