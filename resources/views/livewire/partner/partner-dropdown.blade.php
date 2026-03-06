<div wire:ignore.self class="partners-dropdown-container">
    <div class="partners-dropdown-list">
        <a href="#" wire:click.prevent="selectCategory('')" class="dropdown-item">
            Все партнёры
        </a>

        @foreach ($categories as $category)
            <a href="#" wire:click.prevent="selectCategory({{ $category->id }})" class="dropdown-item">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <style>
        .partners-dropdown-container {
            background-color: #fff;
            /* Белый фон */
            border: 1px solid #eee;
            /* Легкая рамка */
            border-radius: 4px;
        }

        .partners-dropdown-list {
            display: block;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px 0;
        }

        .dropdown-item {
            display: block;
            padding: 8px 15px;
            color: #000 !important;
            /* ЧЕРНЫЙ ЦВЕТ ШРИФТА */
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            /* Легкий серый фон при наведении */
        }
    </style>
</div>
