<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Dashboard\Index;
use App\Livewire\Event\EventShow;


//События главная
Route::get('/', function () {
    return view('events.index');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/dashboard', Index::class)->middleware(['auth'])->name('dashboard');

Route::get('/event/{event}', EventShow::class)->name('event.show');
