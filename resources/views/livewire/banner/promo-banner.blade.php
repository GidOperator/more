<div class="promo-banner-container">
    <div class="banner-body" style="background-image: url({{ $image }});">
        <!-- <img src="{{ $image }}" alt="{{ $title }}" class="banner-img"> -->

        {{-- Затемнение поверх картинки --}}
        <div class="banner-overlay"></div>

        <div class="banner-content">
            <div class="banner-text-block">
                <p class="banner-title">{{ $title }}</p>
            </div>

            @if ($viewType === 'button')
            <a href="{{ $link }}" class="btn --blue">
                Открыть новые возможности
            </a>
            @else
            <a href="{{ $link }}" class="banner-link">
                К настройкам фильтра <span class="icon-rght"></span>
            </a>
            @endif
        </div>
    </div>

    <style>
        .banner-body {
            position: relative;
            width: 100%;
            height: 350px;
            /* Фиксированная высота для теста */
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            background-color: #eee;
        }

        .banner-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 0.7) 100%);
            z-index: 2;
        }

        .banner-content {
            position: relative;
            z-index: 3;
            width: 100%;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            color: white;
        }

        .banner-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            max-width: 400px;
            line-height: 1.2;
            /* Помнишь, ты хотел чуть выше? Увеличивай margin-bottom */
            margin-bottom: 10px;
        }

        .banner-btn {
            background: #0B6FF6;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            transition: 0.3s;
        }

        .banner-btn:hover {
            background: #0856c1;
        }

        .banner-link {
            color: white;
            text-decoration: underline;
            font-weight: 600;
        }
    </style>
</div>