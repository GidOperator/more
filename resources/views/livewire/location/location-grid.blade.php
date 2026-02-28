<div>
    <div class="row g-4">
        @forelse ($locations as $location)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    {{-- Главное изображение локации --}}
                    @if ($location->mainImage)
                        <img src="{{ asset('storage/' . $location->mainImage->path) }}" class="card-img-top"
                            alt="{{ $location->mainImage->alt ?? $location->name }}"
                            style="height: 200px; object-fit: cover;">
                    @else
                        {{-- Заглушка, если нет фото --}}
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height: 200px;">
                            <span class="text-muted">Нет фото</span>
                        </div>
                    @endif

                    <div class="card-body">
                        {{-- Тип локации (например, Ресторан) --}}
                        <h6 class="card-subtitle mb-2 text-primary">
                            {{ $location->location_type->name ?? 'Без типа' }}
                        </h6>

                        {{-- Название --}}
                        <h5 class="card-title">{{ $location->name }}</h5>

                        {{-- Описание --}}
                        <p class="card-text text-muted small">
                            {{ Str::limit($location->description, 100) }}
                        </p>
                    </div>

                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                <i class="fas fa-map-marker-alt"></i> {{ $location->city->name ?? 'Не указан' }}
                            </span>
                            <a href="#" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">Локаций по выбранным критериям не найдено</h4>
            </div>
        @endforelse
    </div>
</div>
