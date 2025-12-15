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
                                style="cursor: pointer;"
                                @mouseenter="activeCategory = {{ $category->id }}; $wire.set('selectedCategory', {{ $category->id }}); $wire.set('selectedSubcategory', null)">
                                {{ $category->name }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Справа: Подкатегории выбранной категории -->
            <div class="col-8 h-100 overflow-auto">
                <ul class="list-unstyled mb-0">
                    @if ($categories)
                        @php
                            $selected = $categories->firstWhere('id', $selectedCategory);
                        @endphp
                        @if ($selected && $selected->subcategories)
                            @foreach ($selected->subcategories as $sub)
                                <li class="p-2 rounded" style="cursor: pointer;"
                                    @mouseover="this.style.backgroundColor='#f0f0f0'"
                                    @mouseout="this.style.backgroundColor='transparent'"
                                    wire:click="$set('selectedSubcategory', {{ $sub->id }})">
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
