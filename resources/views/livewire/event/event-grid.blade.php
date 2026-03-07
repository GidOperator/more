<div x-data="{ loading: false }"
    x-on:scroll.window.throttle.200ms="
        if (loading) return; 
        if ((window.scrollY + window.innerHeight) > (document.documentElement.scrollHeight - 300)) {
            loading = true;
            $wire.call('loadMore');
        }
     "
    x-on:loaded.window="loading = false">

    {{-- Переключатель вида --}}
    <div class="sorting-bar">
        <div class="listing-switch-group">
            <button type="button" class="listing-switch-btn {{ $view === 'grid' ? 'active' : '' }}"
                wire:click="changeView('grid')">
                <span class="sort-icon icon-cards"></span>
            </button>
            <button type="button" class="listing-switch-btn {{ $view === 'list' ? 'active' : '' }}"
                wire:click="changeView('list')">
                <span class="sort-icon icon-list"></span>
            </button>
        </div>
    </div>

    {{-- Отрисовка списка или сетки --}}
    <div class="{{ $view === 'grid' ? 'grid-4-cols' : 'list-group' }}">
        @forelse($events as $event)
            {{-- Вызов компонента карточки --}}
            <livewire:event.event-card :event="$event" :view="$view" :key="$view . '-' . $event->id" />
        @empty
            <p>События не найдены</p>
        @endforelse
    </div>

    <div class="text-center my-3" x-show="loading">Загрузка...</div>
</div>
