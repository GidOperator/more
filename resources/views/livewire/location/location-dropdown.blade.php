<div class="simple-dropdown">
    <div class="simple-dropdown__box">
        @forelse ($categories as $category)
            <button type="button" class="simple-dropdown__link w-100 border-0 bg-transparent text-start"
                wire:key="loc-{{ $category->id }}" wire:click="selectCategory({{ $category->id }})">

                {{-- Используем flexbox для контента --}}
                <div class="simple-dropdown__link-content d-flex align-items-center">
                    @if ($category->svg_icon)
                        <span class="simple-dropdown__icon d-flex align-items-center justify-content-center">
                            {!! $category->svg_icon !!}
                        </span>
                    @endif

                    <span class="simple-dropdown__name">
                        {{ $category->name }}
                    </span>
                </div>
            </button>
        @empty
            <div class="p-3 text-muted">Категории не найдены</div>
        @endforelse
    </div>

    <style>
        .simple-dropdown__box {
            /* Если контейнер имеет padding, пробел может быть там */
            padding: 0;
            margin: 0;
        }

        .simple-dropdown__link {
            /* Убираем все отступы у самой кнопки */
            padding: 8px 15px;
            /* Задайте нужный padding здесь, если нужно */
            margin: 0;
            display: block;
            transition: background-color 0.2s;
        }

        .simple-dropdown__link:hover {
            background-color: #f8f9fa;
            /* Добавьте эффект наведения, если нет */
        }

        .simple-dropdown__link-content {
            /* Контент внутри кнопки */
            gap: 10px;
            /* Расстояние между иконкой и текстом */
        }

        .simple-dropdown__icon {
            /* Настройка иконки */
            width: 24px;
            /* Фиксированная ширина */
            height: 24px;
            /* Фиксированная высота */
        }


        .simple-dropdown__icon svg {
            display: block;
            min-width: 24px;
            min-height: 24px;
        }

        .simple-dropdown__name {
            /* Чтобы текст не создавал пробел */
            line-height: 1.2;
        }
    </style>
</div>
