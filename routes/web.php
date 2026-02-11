<?php

use App\Models\Notes;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/notes', function () {
        return view('notes.index');
    })->name('notes.index');



    Route::get('/notes/create', function () {
        return view('notes.create');
    })->name('notes.create');


    Volt::route('/notes/{note}/edit', 'notes.edit-note')
        ->name('notes.edit');
});

// Public View
Route::get('/notes/{note}', function (Notes $note) {
    if (! $note->is_published) {
        abort(404);
    }
    $user = $note->user;  // who sent this note
    return view('notes.view', ['note' => $note, 'user' => $user]);
})->name('notes.view');


Route::middleware('auth')->get('/calendar/notes', function () {
    return \App\Models\Notes::whereNotNull('send_date')
        ->where('user_id', auth()->id())
        ->selectRaw('DATE(send_date) as date')
        ->distinct()
        ->get()
        ->map(fn($n) => [
            'start'  => $n->date,
            'display' => 'list-item', // 🔥 FORCE DOT
        ]);
});
