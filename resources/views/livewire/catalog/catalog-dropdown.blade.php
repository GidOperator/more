<div class="mega-menu">
    <div class="mega-menu__scroller">
        <div class="mega-menu__inner">
            @foreach ($categories as $category)
            <div class="mega-menu__col">
                <div class="menu-link-wrap">
                    <button class="icon-plus menu-toggle level-2 d-lg-none"></button>
                    <a href="#" class="h6 mega-menu__category"
                        @click="$wire.toggleCategory({{ $category->id }}); isCatalogOpen = false;"
                        style="cursor:pointer;">
                        @if ($category->icon_svg)
                        <span class="menu-item__icon">
                            {!! $category->icon_svg !!}
                        </span>
                        @endif
                        <span class="menu-item__name">{{ $category->name }}</span>
                    </a>
                </div>
                <div class="subcategories-list-wrap">
                    <ul class="mega-menu__subcategories-list">
                        @foreach ($category->subcategories as $sub)
                        <li class="mega-menu__item">
                            <a href="#" class="mega-menu__item-link"
                                @click.prevent="
                                            $wire.selectSubcategory({{ $sub->id }});
                                            Livewire.dispatch('subcategorySelected', { subcategoryId: {{ $sub->id }} });
                                            isCatalogOpen = false;
                                        ">
                                {{ $sub->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>