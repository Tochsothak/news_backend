<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/settings/system-health', function () {
    return view('settings.system-health');
})->name('settings.system-health');

