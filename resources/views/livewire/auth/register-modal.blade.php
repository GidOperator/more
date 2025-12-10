<div>
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1"
        @if ($showModal) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered reg-modal">
            <div class="modal-content rounded-4 shadow">

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

                    @if ($mode === 'input')
                    <form wire:submit.prevent="startRegister" class="reg-form">
                        <div class="form-group">
                            <div class="radio-group d-flex flex-column">
                                @foreach (\App\Models\Role::all() as $r)
                                <div class="form-check radio-input">
                                    <input class="form-check-input" type="radio" id="role_{{ $r->id }}"
                                        value="{{ $r->id }}" wire:model.defer="role">
                                    <label class="form-check-label" for="role_{{ $r->id }}">
                                        {{ $r->name }}
                                        <span class="radio-input__button"></span>
                                    </label>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="fields-group d-flex flex-column">
                            <input wire:model.defer="phone" type="text"
                                placeholder="+7 (999) 999-99-99" class="form-control"
                                maxlength="11" pattern="[0-9]*" inputmode="numeric">
                            @error('phone')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            <input wire:model.defer="password" type="password" placeholder="Пароль"
                                class="form-control">
                            <input wire:model.defer="password_confirmation" type="password" placeholder="Повтор"
                                class="form-control">
                            @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-policy-wrap">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="policyCheck"
                                    wire:model.defer="policyAccepted">
                                <label class="form-check-label small" for="policyCheck">
                                    Я принимаю <a href="/policy" target="_blank">политику обработки персональных данных</a> и
                                    <a href="/terms" target="_blank">пользовательское
                                        соглашение</a>
                                </label>
                            </div>
                            @error('policyAccepted')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="submit-wrap">
                            <button type="submit" class="submit btn --blue">Зарегистрироваться</button>
                        </div>
                    </form>
                    @endif

                    @if ($mode === 'verify')
                    <form wire:submit.prevent="verifyCode" class="verify-form d-flex flex-column">
                        <input wire:model.defer="code" type="text" placeholder="Код из SMS" class="form-control">
                        @error('code')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <div class="submit-wrap">
                            <button type="submit" class="submit btn --blue">Подтвердить</button>
                        </div>
                    </form>
                    @endif

                    @if ($mode === 'login')
                    <form wire:submit.prevent="login" class="login-form d-flex flex-column">
                        <input wire:model.defer="loginPhone" type="text" placeholder="Телефон (11 цифр)"
                            class="form-control" maxlength="11" pattern="[0-9]*" inputmode="numeric">
                        <input wire:model.defer="loginPassword" type="password" placeholder="Пароль"
                            class="form-control">
                        @error('loginPhone')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        @error('loginPassword')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <div class="submit-wrap --row">
                            <button type="submit" class="submit btn --blue">Войти</button>
                            <button class="link"
                                wire:click="
                                        $dispatch('close-register-modal');
                                        $dispatch('show-forgot-password-modal');
                                    ">
                                Забыли пароль?
                            </button>
                        </div>
                    </form>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>