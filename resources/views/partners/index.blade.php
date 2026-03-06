@extends('layouts.app')

@section('content')
    <div class="content-section">
        <h1 class="page-heading">Все парнеры</h1>
        <livewire:partner.partner-grid :city_slug="$city_slug" />
    </div>
@endsection
