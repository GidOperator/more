<div class="mega-menu">
    <div class="mega-menu__inner">
        @foreach ($categories as $category)
        <div class="mega-menu__col">
            <a href="#" class="h6 mega-menu__category"
                @click="$wire.toggleCategory({{ $category->id }}); isCatalogOpen = false;"
                style="cursor:pointer;">

                @if ($category->icon_svg)
                <span class="me-2" style="width:20px;">
                    {!! $category->icon_svg !!}
                </span>
                @endif
                {{ $category->name }}
            </a>

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
        @endforeach
    </div>
</div>