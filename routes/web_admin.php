<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;

// route usage
// Route with method and name
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
    Route::get('/owners/create', [OwnerController::class, 'create'])->name('owners.create');
    Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');
    Route::get('/owners/{owner}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
    Route::put('/owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{owner}', [OwnerController::class, 'destroy'])->name('owners.destroy');

    Route::get('/tenants', [AdminTenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [AdminTenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [AdminTenantController::class, 'store'])->name('tenants.store');
    Route::get('/tenants/{tenant}', [AdminTenantController::class, 'show'])->name('tenants.show');
    Route::get('/tenants/{tenant}/edit', [AdminTenantController::class, 'edit'])->name('tenants.edit');
    Route::put('/tenants/{tenant}', [AdminTenantController::class, 'update'])->name('tenants.update');
    Route::delete('/tenants/{tenant}', [AdminTenantController::class, 'destroy'])->name('tenants.destroy');
    Route::post('/tenants/{tenant}/assign/{owner}', [AdminTenantController::class, 'assignToOwner'])
        ->name('tenants.assign');
});


