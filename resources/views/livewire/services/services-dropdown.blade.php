<div class="services-list-container">
    <div class="list-group">
        @foreach ($categories as $category)
            <button type="button"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                wire:click="selectCategory({{ $category->id }})">
                {{ $category->name }}
                <i class="bi bi-chevron-right small text-muted"></i>
            </button>
        @endforeach
    </div>
</div>
