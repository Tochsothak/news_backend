<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// Settings Routes
Route::get('/settings/system-health', function () {
    return view('settings.system-health');
})->name('settings.system-health');

// Categories Routes
Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

Route::get('/categories/create', function () {
    return view('categories.create');
})->name('categories.create');

Route::get('/categories/sub-categories', function () {
    return view('categories.sub-categories');
})->name('categories.sub-categories');

Route::get('/categories/reorder', function () {
    return view('categories.reorder');
})->name('categories.reorder');

Route::get('/categories/{id}/edit', function ($id) {
    return view('categories.edit', ['id' => $id]);
})->name('categories.edit');
