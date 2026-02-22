@extends('layouts.app')

@section('content')
<div class="content-section">
    <h1 class="page-heading">Все события</h1>
    <livewire:event.event-grid />
</div>
<div class="content-section">
    <livewire:event-organizers.event-organizers-grid wire:key="organizers-grid" />
</div>
<div class="content-section">
    <div class="promo-section">
        @livewire('banner.promo-banner', [
        'title' => 'Не нашли события на подходящие даты?',
        'text' => 'Какой то текст',
        'image' => '/images/young-girl-bnr.jpg',
        'link' => '/routes',
        'viewType' => 'link',
        ])
    </div>
</div>
<div class="content-section">
    <livewire:review.event-reviews />
</div>
<div class="content-section">
    <div class="promo-section promo-2">
        @livewire('banner.promo-banner', [
        'title' => 'Хотите участвовать в мероприятиях? Есть идеи или предложения?',
        'text' => 'Какой то текст',
        'image' => '/images/people.jpg',
        'link' => '/about',
        'viewType' => 'button',
        ])
    </div>
</div>
@endsection