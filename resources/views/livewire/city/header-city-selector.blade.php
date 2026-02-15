<div class="header-city-selector-container" style="position: relative;" x-data="{ open: false, showConfirmPopup: @entangle('showConfirm') }"
    x-on:open-city-modal.window="open = true" x-on:close-city-modal.window="open = false">

    <!-- Текущий город -->
    <div @click="open = true" class="city-selector-active"
        style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
        <i class="icon-location"></i>
        <span style="border-bottom: 1px dashed; line-height: 1;">
            {{ $currentCityName }}
        </span>
    </div>

    <!-- Плашка подтверждения города -->
    <div class="city-confirm-popup" x-show="showConfirmPopup" x-transition
        style="position: absolute; top: calc(100% + 15px); left: 0; background: white; width: 220px; padding: 16px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); z-index: 1000; border: 1px solid #f0f0f0;">

        <div
            style="position: absolute; top: -6px; left: 20px; width: 12px; height: 12px; background: white; transform: rotate(45deg); border-left: 1px solid #f0f0f0; border-top: 1px solid #f0f0f0;">
        </div>

        <p style="margin: 0 0 12px 0; font-size: 14px; color: #333; line-height: 1.4;">
            Ваш город <strong>{{ $detectedCity['name'] ?? '' }}</strong>?
        </p>

        <div style="display: flex; gap: 8px;">
            <button wire:click="confirmCity"
                style="flex: 1; background: #4f46e5; color: white; border: none; padding: 6px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500;">
                Да
            </button>
            <button wire:click="declineCity"
                style="flex: 1; background: #f3f4f6; color: #4b5563; border: none; padding: 6px; border-radius: 6px; cursor: pointer; font-size: 13px;">
                Нет
            </button>
        </div>
    </div>

    <!-- Модалка выбора города -->
    <template x-teleport="body">
        <div x-show="open" x-cloak class="city-modal-overlay"
            style="position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; backdrop-filter: blur(2px);">

            <div @click.away="open = false" class="city-modal-container"
                style="background: white; width: 100%; max-width: 450px; border-radius: 12px; overflow: hidden;">

                <!-- Заголовок -->
                <div
                    style="padding: 15px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: bold;">Выберите город</span>
                    <button @click="open = false"
                        style="background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
                </div>

                <!-- Поиск города -->
                <div style="padding: 20px;">
                    <input type="text" wire:model.live.debounce.300ms="search" x-init="$watch('open', value => value && setTimeout(() => $el.focus(), 100))"
                        placeholder="Начните вводить название..."
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <!-- Список городов -->
                <div style="max-height: 350px; overflow-y: auto;">
                    @if (count($this->results) > 0)
                        @foreach ($this->results as $city)
                            <div wire:click="selectCity('{{ $city->name }}')" class="city-item"
                                style="padding: 12px 20px; cursor: pointer;">
                                <strong>{{ $city->name }}</strong>
                                <div style="font-size: 12px; color: #888;">{{ $city->region }}</div>
                            </div>
                        @endforeach
                    @else
                        <div style="padding: 15px 20px;">
                            <button wire:click="selectCity('Москва')" class="pop-city-btn">Москва</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
