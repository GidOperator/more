<div class="promo-banner-container">
    <div class="banner-body">
        <img src="{{ $image }}" alt="{{ $title }}" class="banner-img">

        {{-- Затемнение поверх картинки --}}
        <div class="banner-overlay"></div>

        <div class="banner-content">
            <div class="banner-content__heading">
                <div class="banner-title h3">{{ $title }}</div>
            </div>
            <div class="banner-content__text">
                <p>Здесь вывод текста баннера. Здесь вывод текста баннера. Здесь вывод текста баннера. Здесь вывод текста баннера.</p>
            </div>

            @if ($viewType === 'button')
            <a href="{{ $link }}" class="btn --blue">
                Открыть новые возможности
            </a>
            @else
            <a href="{{ $link }}" class="banner-link">
                <span>К настройкам фильтра</span> <span class="icon-rght banner-link__icon"></span>
            </a>
            @endif
        </div>
    </div>
</div>