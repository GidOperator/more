<div class="mega-menu">
    <div class="container">
        <div class="mega-menu__grid">
            @foreach ($categories as $category)
                <a href="#" class="mega-menu__card" wire:key="cat-{{ $category->id }}" style="text-decoration: none;">
                    <div class="mega-menu__card-content">
                        <span class="mega-menu__card-name" style="color: #000; font-weight: 600;">
                            {{ $category->name }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
