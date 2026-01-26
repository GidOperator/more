<div x-data="{ isCatalogOpen: @entangle('showMenu') }" class="position-relative">
    <div x-show="isCatalogOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" @click.away="isCatalogOpen = false"
        class="position-absolute start-0 bg-white shadow-lg border rounded-3 p-4"
        style="z-index:9999; width:95vw; max-width:1200px; top:110%; left:0; display: none;">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 overflow-auto"
            style="max-height:70vh;">
            @foreach ($categories as $category)
                <div class="col">
                    <h6 class="fw-bold text-uppercase mb-2 pb-1 border-bottom d-flex align-items-center"
                        @click="$wire.toggleCategory({{ $category->id }}); isCatalogOpen = false;"
                        style="cursor:pointer;">

                        @if ($category->icon_svg)
                            <span class="me-2" style="width:20px;">
                                {!! $category->icon_svg !!}
                            </span>
                        @endif
                        {{ $category->name }}
                    </h6>

                    <ul class="list-unstyled">
                        @foreach ($category->subcategories as $sub)
                            <li class="mb-1">
                                <a href="#" class="text-decoration-none text-secondary small hover-blue"
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
</div>
