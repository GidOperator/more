<div class="services-grid">
    @foreach ($services as $service)
        <div class="service-card">
            {{-- Вывод картинки (если есть) --}}
            @if ($service->mainImage)
                <img src="{{ asset('storage/' . $service->mainImage->path) }}" alt="{{ $service->mainImage->alt }}">
            @endif

            <h3>{{ $service->name }}</h3>
            <p>{{ $service->description }}</p>

            <div class="meta">
                <p>Категория: {{ $service->category_partner->name ?? 'Без категории' }}</p>

                {{-- Вывод партнера и его пользователя --}}
                @if ($service->partner)
                    <p>Партнер: {{ $service->partner->name }}</p>
                    <p>Владелец (User): {{ $service->partner->user->name ?? 'Не указан' }}</p>
                @endif

                <p>Цена: {{ $service->price }} {{ $service->is_price_from ? '(от)' : '' }}</p>
            </div>
        </div>
    @endforeach
</div>
