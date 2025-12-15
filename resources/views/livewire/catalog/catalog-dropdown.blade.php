<div class="position-relative" x-data="{ open: false }">
    <!-- Кнопка Каталог -->
    <button @click="open = !open" class="btn btn-primary text-dark">
        Каталог
    </button>

    <!-- Большое меню -->
    <div x-show="open" x-transition @click.away="open = false"
        class="position-absolute start-0 bg-white shadow overflow-auto"
        style="top: 50px; width: 90vw; height: 50vh; background-color: rgba(255, 255, 255, 0.95); z-index: 1050; padding: 20px; color: black;">
        <ul class="list-unstyled mb-0 row">
            @foreach ($categories as $category)
                <li class="col-4 mb-3" x-data="{ expanded: true }">
                    <!-- Категория -->
                    <div class="d-flex justify-content-between align-items-center p-2 border rounded"
                        style="cursor: pointer; color: black;"
                        @click="expanded = !expanded; $wire.set('selectedCategory', {{ $category->id }}); $wire.set('selectedSubcategory', null)">
                        <span>{{ $category->name }}</span>
                        @if (count($category->subcategories))
                            <span :class="{ 'rotate-90': expanded }"
                                style="display:inline-block; transition: transform 0.2s;">▶</span>
                        @endif
                    </div>

                    <!-- Подкатегории -->
                    @if (count($category->subcategories))
                        <ul x-show="expanded" x-transition class="list-unstyled ms-3 mt-1">
                            @foreach ($category->subcategories as $sub)
                                <li class="p-1 rounded" style="cursor: pointer;"
                                    @click="$wire.set('selectedSubcategory', {{ $sub->id }})"
                                    @mouseover="this.style.backgroundColor='#f0f0f0'"
                                    @mouseout="this.style.backgroundColor='transparent'">
                                    └─ {{ $sub->name }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
