<?php

use Illuminate\Support\Facades\Route;

// route usage
// Route with method and name
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Separate route files for admin and owner
require __DIR__ . '/web_admin.php';
require __DIR__ . '/web_owner.php';
