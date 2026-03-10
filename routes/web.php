<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// ==========================================
// Articles Routes
// ==========================================

Route::get('/articles', function () {
    return view('articles.index');
})->name('articles.index');

Route::get('/articles/create', function () {
    return view('articles.create-article');
})->name('articles.create');

Route::get('/articles/drafts', function () {
    return view('articles.drafts');
})->name('articles.drafts');

Route::get('/articles/published', function () {
    return view('articles.published');
})->name('articles.published');

Route::get('/articles/scheduled', function () {
    return view('articles.scheduled');
})->name('articles.scheduled');

Route::get('/articles/trash', function () {
    return view('articles.trash');
})->name('articles.trash');

Route::get('/articles/{id}/edit', function ($id) {
    return view('articles.edit-article', ['id' => $id]);
})->name('articles.edit');

// ==========================================
// Advertisements Routes
// ==========================================

Route::get('/ads', function () {
    return view('ads.index');
})->name('ads.index');

Route::get('/ads/create', function () {
    return view('ads.create-ad');
})->name('ads.create');

Route::get('/ads/{id}/edit', function ($id) {
    return view('ads.edit-ad', ['id' => $id]);
})->name('ads.edit');

Route::get('/ads/zones', function () {
    return view('ads.zones');
})->name('ads.zones');

Route::get('/ads/reports', function () {
    return view('ads.reports');
})->name('ads.reports');

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


// Settings Routes
Route::get('/settings/system-health', function () {
    return view('settings.system-health');
})->name('settings.system-health');
