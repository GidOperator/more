<div class="simple-dropdown">
    <div class="simple-dropdown__box">
        @foreach ($categories as $category)
        <a href="#" class="simple-dropdown__link" wire:key="cat-{{ $category->id }}">
            <div class="simple-dropdown__link-content">
                <span class="simple-dropdown__name">
                    {{ $category->name }}
                </span>
            </div>
        </a>
        @endforeach
    </div>
</div>