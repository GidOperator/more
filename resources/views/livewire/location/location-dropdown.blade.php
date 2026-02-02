<div class="mega-menu">
    <div class="container">
        <div class="mega-menu__grid">
            @forelse ($categories as $category)
                {{-- Убираем стандартное подчеркивание ссылки --}}
                <a href="#" class="mega-menu__card" wire:key="loc-{{ $category->id }}" style="text-decoration: none;">
                    <div class="mega-menu__card-content">
                        @if (isset($category->icon_svg) && $category->icon_svg)
                            <span class="mega-menu__card-icon" style="color: #000;">
                                {!! $category->icon_svg !!}
                            </span>
                        @endif

                        {{-- Добавляем черный цвет напрямую --}}
                        <span class="mega-menu__card-name" style="color: #000; font-weight: 600;">
                            {{ $category->name }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="p-3 text-muted">Локации не найдены</div>
            @endforelse
        </div>
    </div>
</div>
