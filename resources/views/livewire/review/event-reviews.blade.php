<div>
    <div class="section-header">
        <h2 class="section-title">
            Отзывы о прошедших событиях
        </h2>
        <a href="#" class="show-more">
            <span>Показать ещё</span> <span class="icon-rght"></span>
        </a>
    </div>
    <div class="reviews-grid">
        @forelse($reviews as $review)
        <div class="review-card">
            <div class="review-card__title">Заголовок события</div>
            <div class="review-card__info">
                <div class="raiting">
                    <div class="raiting-stars">
                        <img src="/images/raiting_star-yellow.svg" alt="">
                        <img src="/images/raiting_star-yellow.svg" alt="">
                        <img src="/images/raiting_star-yellow.svg" alt="">
                        <img src="/images/raiting-star.svg" alt="">
                        <img src="/images/raiting_star-grey.svg" alt="">
                    </div>
                    <div class="raiting-stars__value">
                        4,2
                    </div>
                </div>
                <div class="review-card__date">
                    {{ $review->created_at->format('d.m.Y') }}
                </div>
            </div>
            <div class="review-card__text">
                <p>{{ $review->review }}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cupiditate debitis voluptas inventore quas magnam nam eos vitae et deserunt quasi.
                </p>
            </div>
            <div class="review-card__user">
                <div class="review-card__avatar">
                    <img src="storage/people/693189136f869.jpg" class="review-card__avatar-image" alt="">
                </div>
                <div class="review-card__user-name">
                    Евгений Иванов <!-- Времянка -->
                    {{ $review->author_name }}
                </div>
            </div>
            @if ($review->images->isNotEmpty())
            <div class="mt-2 d-none">
                @foreach ($review->images as $image)
                <img src="{{ asset('storage/' . $image->path) }}" class="w-24 h-24 object-cover" alt="">
                @endforeach
            </div>
            @endif
        </div>

        @empty
        <p class="text-gray-500">Отзывов пока нет</p>
        @endforelse
    </div>
</div>