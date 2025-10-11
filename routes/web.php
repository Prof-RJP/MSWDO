<?php

use App\Http\Controllers\AicsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clients', [ClientsController::class, 'index'])->name('admin.client');
    Route::get('/clients/add-client', [ClientsController::class, 'create'])->name('admin.add-client');
    Route::post('/clients/store', [ClientsController::class, 'store'])->name('client.store');
    Route::get('/client/{client}/aics', [ClientsController::class, 'view'])->name('client.view-AICS');
    Route::get('/client/{id}/edit',[ClientsController::class,'edit'])->name('client.edit');
    Route::put('/client/{id}/update',[ClientsController::class,'update'])->name('client.update');


    Route::get('/AICS', [AicsController::class, 'show'])->name('admin.AICS');
    Route::get('/AICS/add-AICS', [AicsController::class, 'create'])->name('admin.add-AICS');
    Route::post('/AICS/add-AICS/store', [AicsController::class, 'store'])->name('AICS.store');
    Route::get('/AICS/{id}/edit',[AicsController::class,'edit'])->name('AICS.edit');
    Route::put('/AICS/{id}/update',[AicsController::class,'update'])->name('AICS.update');
});

require __DIR__ . '/auth.php';
