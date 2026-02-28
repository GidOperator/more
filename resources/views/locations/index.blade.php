@extends('layouts.app')

@section('content')
    <div class="content-section">
        <h1 class="page-heading">Все площадки и локации</h1>
        <livewire:location.location-grid />
    </div>
@endsection
