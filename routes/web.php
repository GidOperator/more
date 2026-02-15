<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Dashboard\Index;
use App\Livewire\Event\EventShow;
use App\Livewire\Event\EventCreate;
use App\Livewire\Cabinet\OrganizerCabinet;
use App\Livewire\Cabinet\ParticipantCabinet;
use App\Livewire\Cabinet\PartnerCabinet;

// --- 1. СЛУЖЕБНЫЕ РОУТЫ (БЕЗ ПРЕФИКСА ГОРОДА) ---
// Эти роуты должны быть выше, чтобы их не перехватил {city_slug}
Route::get('/clear-city', function () {
    session()->forget([
        'selected_city_id',
        'selected_city_name',
        'selected_city_slug',
        'city_confirmed',
        'detected_city_id',
        'detected_city_name',
        'detected_city_slug',
    ]);
    return 'City session cleared';
});

Route::get('/login', function () {
    return redirect('/')->with('open-login-modal', true);
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/', function () {
    $slug = session('selected_city_slug') ?? session('detected_city_slug');
    if ($slug) {
        // Перенаправляем и создаем flash-переменную 'force_confirm'
        return redirect()->to("/{$slug}")->with('force_confirm', true);
    }
    return view('welcome');
});

// Кабинеты
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
    Route::get('/cabinet/organizer', OrganizerCabinet::class)->name('cabinet.organizer');
    Route::get('/cabinet/participant', ParticipantCabinet::class)->name('cabinet.participant');
    Route::get('/cabinet/partner', PartnerCabinet::class)->name('cabinet.partner');
});

// --- 3. ГРУППА ГОРОДА (ОСНОВНОЙ КОНТЕНТ) ---
Route::prefix('{city_slug}')->group(function () {

    // Главная страница города
    Route::get('/', function ($city_slug) {
        \App\Models\City::where('slug', $city_slug)->firstOrFail();
        return view('events.index');
    })->name('events.index');

    // События
    Route::get('/event/create', EventCreate::class)->name('event.create');
    Route::get('/event/{event}', EventShow::class)->name('event.show');
});
