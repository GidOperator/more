<div class="header-city-selector-container" x-data="{
    open: false,
    showConfirmPopup: $wire.entangle('showConfirm')
}" x-on:open-city-modal.window="open = true"
    x-on:close-city-modal.window="open = false" x-cloak {{-- Добавляем сюда тоже --}}>

    <div @click="open = true" class="city-selector-active">
        <span class="city-icon icon-geo"></span>
        <span class="current-city-name">
            {{ $currentCityName }}
        </span>
    </div>

    {{-- Добавили x-cloak, чтобы не мигала --}}
    <div class="city-confirm-popup" x-show="showConfirmPopup" x-transition x-cloak>
        <div class="city-confirm-popup__decor"></div>

        <div class="city-ask">
            Ваш город <strong>{{ $detectedCity['name'] ?? '' }}</strong>?
        </div>

        <div class="confirm-city-btns">
            <button wire:click="confirmCity" class="btn --blue --small">Да</button>
            {{-- Можно добавить @click="showConfirmPopup = false", чтобы плашка исчезала мгновенно --}}
            <button wire:click="declineCity" class="btn --grey --small">Нет</button>
        </div>
    </div>

    <template x-teleport="body">
        <div x-show="open" x-cloak class="city-modal-overlay">
            <div @click.away="open = false" class="city-modal-container">
                <div class="city-chose-heading">
                    <b>Выберите город</b>
                    <button @click="open = false" class="btn-close"></button>
                </div>

                <div>
                    <input type="text" wire:model.live.debounce.300ms="search" x-init="$watch('open', value => value && setTimeout(() => $el.focus(), 100))"
                        placeholder="Начните вводить название..." class="form-control">
                </div>

                <div class="city-list">
                    @if (count($this->results) > 0)
                        @foreach ($this->results as $city)
                            {{-- Добавлен wire:key для корректной работы Livewire --}}
                            <div wire:click="selectCity('{{ $city->name }}')" wire:key="city-{{ $city->id }}"
                                class="city-item">
                                <span>{{ $city->name }}</span>
                                <div class="city-region">{{ $city->region }}</div>
                            </div>
                        @endforeach
                    @elseif(mb_strlen($search) > 1)
                        <div class="city-item">Город не найден</div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
