<div class="py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Найдено партнеров: {{ $partners->count() }}
        </h2>
    </div>

    @if ($partners->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
            <p class="text-yellow-700">В этом разделе пока нет партнеров.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($partners as $partner)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-200 flex flex-col">

                    {{-- 1. Ссылка на Логотип --}}
                    <a href="{{ $partner->slug ? url((string) $partner->slug) : '#' }}"
                        class="block h-48 bg-gray-50 border-b border-gray-100 p-4 overflow-hidden">
                        @if ($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->company_name }}"
                                class="object-contain h-full w-full hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex flex-col items-center justify-center h-full">
                                <span class="text-gray-300 text-6xl">🏢</span>
                            </div>
                        @endif
                    </a>

                    {{-- 2. Контентная часть --}}
                    <div class="p-5 flex-grow">
                        {{-- Ссылка на Заголовок --}}
                        <a href="{{ url('/' . ($partner->slug ?? $partner->id)) }}" class="block group">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-2">
                                {{ $partner->company_name ?? 'Без названия' }}
                            </h3>
                        </a>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-2">
                            {{ $partner->company_name ?? 'Без названия' }}
                        </h3>
                        </a>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ $partner->description ?? 'Описание партнера пока не добавлено...' }}
                        </p>
                    </div>

                    {{-- 3. Футер с контактами (здесь отдельные ссылки) --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                        <div class="flex flex-col gap-2">
                            @if ($partner->phone)
                                <a href="tel:{{ $partner->phone }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 flex items-center gap-2">
                                    <span class="opacity-70">📞</span> {{ $partner->phone }}
                                </a>
                            @endif

                            @if ($partner->website)
                                <a href="{{ str_starts_with($partner->website, 'http') ? $partner->website : 'https://' . $partner->website }}"
                                    target="_blank"
                                    class="text-sm text-blue-500 hover:text-blue-700 font-medium flex items-center gap-2">
                                    <span>🌐</span> Перейти на сайт
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
