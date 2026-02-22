<div class="header-city-selector-container" x-data="{ open: false, showConfirmPopup: @entangle('showConfirm') }"
    x-on:open-city-modal.window="open = true" x-on:close-city-modal.window="open = false">

    <!-- Текущий город -->
    <div @click="open = true" class="city-selector-active">
        <span class="city-icon icon-geo"></span>
        <span class="current-city-name">
            {{ $currentCityName }}
        </span>
    </div>

    <!-- Плашка подтверждения города -->
    <div class="city-confirm-popup" x-show="showConfirmPopup" x-transition>

        <div class="city-confirm-popup__decor">
        </div>

        <div class="city-ask">
            Ваш город <strong>{{ $detectedCity['name'] ?? '' }}</strong>?
        </div>

        <div class="confirm-city-btns">
            <button wire:click="confirmCity" class="btn --blue --small">
                Да
            </button>
            <button wire:click="declineCity" class="btn --grey --small">
                Нет
            </button>
        </div>
    </div>

    <!-- Модалка выбора города -->
    <template x-teleport="body">
        <div x-show="open" x-cloak class="city-modal-overlay">

            <div @click.away="open = false" class="city-modal-container">

                <!-- Заголовок -->
                <div class="city-chose-heading">
                    <b>Выберите город</b>
                    <button @click="open = false" class="btn-close"></button>
                </div>

                <!-- Поиск города -->
                <div>
                    <input type="text" wire:model.live.debounce.300ms="search" x-init="$watch('open', value => value && setTimeout(() => $el.focus(), 100))"
                        placeholder="Начните вводить название..." class="form-control">
                </div>

                <!-- Список городов -->
                <div class="city-list">
                    @if (count($this->results) > 0)
                    @foreach ($this->results as $city)
                    <div wire:click="selectCity('{{ $city->name }}')" class="city-item">
                        <span>{{ $city->name }}</span>
                        <div class="city-region">{{ $city->region }}</div>
                    </div>
                    @endforeach
                
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>