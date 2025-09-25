<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\FlatController;
use App\Http\Controllers\Owner\BillCategoryController;
use App\Http\Controllers\Owner\BillController;

// route usage
// Route with method and name
Route::prefix('owner')->name('owner.')->group(function () {
    Route::get('/flats', [FlatController::class, 'index'])->name('flats.index');
    Route::post('/flats', [FlatController::class, 'store'])->name('flats.store');
    Route::get('/flats/{flat}', [FlatController::class, 'show'])->name('flats.show');
    Route::put('/flats/{flat}', [FlatController::class, 'update'])->name('flats.update');
    Route::delete('/flats/{flat}', [FlatController::class, 'destroy'])->name('flats.destroy');

    Route::get('/categories', [BillCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [BillCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [BillCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [BillCategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
    Route::put('/bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay');
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');
});


