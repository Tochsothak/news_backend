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
    return view('categories.create-category');
})->name('categories.create');

Route::get('/categories/sub-categories/create', function () {
    return view('categories.create-sub-category');
})->name('categories.sub-categories.create');

Route::get('/categories/sub-categories/{id}/edit', function ($id) {
    return view('categories.edit-sub-category', ['id' => $id]);
})->name('categories.sub-categories.edit');

Route::get('/categories/reorder', function () {
    return view('categories.reorder');
})->name('categories.reorder');

// Updated: Changed view from 'categories.edit' to 'categories.edit-category'
Route::get('/categories/{id}/edit', function ($id) {
    return view('categories.edit-category', ['id' => $id]);
})->name('categories.edit');

// Route::post('/categories/reorder', [CategoryController::class, 'reorder']);
