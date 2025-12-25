<div class="position-relative" x-data="{ open: false, activeCategory: null }">
    <!-- Кнопка Каталог -->
    <button @click="open = !open" class="btn btn-primary text-dark">
        Каталог
    </button>

    <!-- Mega Menu -->
    <div x-show="open" x-transition @click.away="open = false" class="position-absolute bg-white shadow overflow-auto"
        style="top: 50px; width: 90vw; height: 50vh; background-color: rgba(255, 255, 255, 0.95); z-index: 1050; padding: 20px; color: black;">
        <div class="row h-100">
            <!-- Слева: Основные категории -->
            <div class="col-4 border-end h-100 overflow-auto">
                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                        <li class="mb-2">
                            <div class="p-2 rounded" :class="{ 'bg-light': activeCategory === {{ $category->id }} }"
                                style="cursor: pointer;" {{-- hover: только визуал + подгрузка подкатегорий --}}
                                @mouseenter="
        activeCategory = {{ $category->id }};
        $wire.set('selectedCategory', {{ $category->id }});
        $wire.set('selectedSubcategory', null);
    "
                                {{-- click: выбор категории + фильтр товаров --}}
                                @click="
        $wire.toggleCategory({{ $category->id }});
        Livewire.dispatch('categorySelected', { categoryId: {{ $category->id }} });
        open = false;
        ">
                                @if ($category->icon_svg)
                                    <span class="me-2">{!! $category->icon_svg !!}</span>
                                @endif
                                {{ $category->name }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Справа: Подкатегории выбранной категории -->
            <div class="col-8 h-100 overflow-auto" x-data="{ activeSubcategory: null }">
                <ul class="list-unstyled mb-0">
                    @if ($categories)
                        @php
                            $selected = $categories->firstWhere('id', $selectedCategory);
                        @endphp
                        @if ($selected && $selected->subcategories)
                            @foreach ($selected->subcategories as $sub)
                                <li class="p-2 rounded" style="cursor: pointer;"
                                    :class="{ 'bg-light': activeSubcategory === {{ $sub->id }} }"
                                    {{-- hover: визуал --}} @mouseover="activeSubcategory = {{ $sub->id }}"
                                    @mouseout="activeSubcategory = null" {{-- click: бизнес-логика --}}
                                    @click="
        $wire.selectSubcategory({{ $sub->id }});
        Livewire.dispatch('subcategorySelected', { subcategoryId: {{ $sub->id }} });
    open = false">
                                    {{ $sub->name }}
                                </li>
                            @endforeach
                        @else
                            <li class="p-2 text-muted">Выберите категорию слева</li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
