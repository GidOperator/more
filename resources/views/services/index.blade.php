@extends('layouts.app')

@section('content')
    <div class="content-section">
        <h1 class="page-heading">Все услуги</h1>
        <livewire:services.services-grid :city_slug="$city_slug" />

    </div>
@endsection
