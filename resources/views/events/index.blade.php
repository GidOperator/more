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
            'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80',
            'link' => '/routes',
            'viewType' => 'link',
        ])
    </div>
    </div>
    <div class="content-section">
        <livewire:review.event-reviews />
    </div>
    <div class="content-section">
        <div class="promo-section">
        @livewire('banner.promo-banner', [
            'title' => 'Работаем на рынке с 1991 года',
            'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
            'link' => '/about',
            'viewType' => 'button',
        ])
        </div>
    </div>
@endsection
