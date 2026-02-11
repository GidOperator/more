<div class="simple-dropdown">
    <div class="simple-dropdown__box">
        @forelse ($categories as $category)
        <a href="#" class="simple-dropdown__link" wire:key="loc-{{ $category->id }}">
            <div class="simple-dropdown__link-content">
                @if (isset($category->icon_svg) && $category->icon_svg)
                <span class="simple-dropdown__icon">
                    {!! $category->icon_svg !!}
                </span>
                @endif

                <span class="simple-dropdown__name">
                    {{ $category->name }}
                </span>
            </div>
        </a>
        @empty
        <div class="p-3 text-muted">Локации не найдены</div>
        @endforelse
    </div>
</div>