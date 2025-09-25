<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;

// route usage
// Route with method and name
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
    Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');
    Route::put('/owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{owner}', [OwnerController::class, 'destroy'])->name('owners.destroy');

    Route::get('/tenants', [AdminTenantController::class, 'index'])->name('tenants.index');
    Route::post('/tenants', [AdminTenantController::class, 'store'])->name('tenants.store');
    Route::get('/tenants/{tenant}', [AdminTenantController::class, 'show'])->name('tenants.show');
    Route::put('/tenants/{tenant}', [AdminTenantController::class, 'update'])->name('tenants.update');
    Route::delete('/tenants/{tenant}', [AdminTenantController::class, 'destroy'])->name('tenants.destroy');
    Route::post('/tenants/{tenant}/assign/{owner}', [AdminTenantController::class, 'assignToOwner'])
        ->name('tenants.assign');
});


