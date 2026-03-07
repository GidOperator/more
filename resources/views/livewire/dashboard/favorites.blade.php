<div class="container py-4">
    <h2 class="mb-4">Избранное</h2>

    @if ($favorites->isEmpty())
        <p>У вас пока нет избранных событий.</p>
    @else
        <div class="row">
            @foreach ($favorites as $favorite)
                <div class="col-md-4">

                    @livewire(
                        'event.event-card',
                        [
                            'event' => $favorite->favoritable,
                            'view' => 'grid',
                        ],
                        key($favorite->id)
                    )
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $favorites->links() }}
        </div>
    @endif
</div>
