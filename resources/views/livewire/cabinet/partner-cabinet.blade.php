<div class="p-4">
    <h1 class="mb-2">Кабинет партнера</h1>
    {{-- Меню --}}
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'services') active @endif"
                wire:click.prevent="setTab('services')">Мои Услуги</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'statistics') active @endif"
                wire:click.prevent="setTab('bookings')">Статистика</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'statistics') active @endif"
                wire:click.prevent="setTab('bookings')">Предложения и отклики</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'documents') active @endif"
                wire:click.prevent="setTab('documents')">Документы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'filters') active @endif"
                wire:click.prevent="setTab('reviews')">Отзывы</a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if ($tab === 'chats') active @endif"
                wire:click.prevent="setTab('chats')">Чаты и уведомления</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab === 'employees') active @endif"
                wire:click.prevent="setTab('settings')">Сотрудники</a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if ($tab === 'profile') active @endif"
                wire:click.prevent="setTab('profile')">Профиль</a>
        </li>
    </ul>

    {{-- Контент --}}
    <div class="card p-3">
        @switch($tab)
            @case('services')
                <livewire:dashboard.services />
            @break

            @case('bookings')
                <livewire:dashboard.bookings />
            @break

            @case('filters')
                <livewire:dashboard.saved-filters />
            @break

            @case('media')
                <livewire:dashboard.media />
            @break

            @case('chats')
                <livewire:dashboard.chats />
            @break

            @case('profile')
                <livewire:dashboard.profile />
            @break
        @endswitch
    </div>
</div>
