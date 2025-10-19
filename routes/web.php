<?php

use App\Http\Controllers\AicsController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeniorCetizenController;
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
    Route::get('/client/{id}/edit', [ClientsController::class, 'edit'])->name('client.edit');
    Route::put('/client/{id}/update', [ClientsController::class, 'update'])->name('client.update');


    Route::get('/AICS', [AicsController::class, 'show'])->name('admin.AICS');
    Route::get('/AICS/add-AICS', [AicsController::class, 'create'])->name('admin.add-AICS');
    Route::post('/AICS/add-AICS/store', [AicsController::class, 'store'])->name('AICS.store');
    Route::get('/AICS/{id}/edit', [AicsController::class, 'edit'])->name('AICS.edit');
    Route::put('/AICS/{id}/update', [AicsController::class, 'update'])->name('AICS.update');

    Route::get('/barangays', [BarangayController::class, 'show'])->name('admin.barangay');
    Route::get('/barangay/add-barangay', [BarangayController::class, 'create'])->name('admin.add-barangay');
    Route::post('/barangay/store', [BarangayController::class, 'store'])->name('barangay.store');

    Route::get('/seniorCetizens', [SeniorCetizenController::class, 'show'])->name('admin.senior');
    Route::get('/seniorCetizens/{brgy_id}/barangay', [SeniorCetizenController::class, 'viewSenior'])->name('admin.view-senior');
    Route::get('/seniorCetizens/add-senior', [SeniorCetizenController::class, 'create'])->name('admin.add-senior');
    Route::post('/seniorCetizens/store', [SeniorCetizenController::class, 'store'])->name('senior.store');
    Route::get('/seniorCetizens/{brgy_id}/edit/{id}', [SeniorCetizenController::class, 'edit'])->name('senior.edit');
    Route::put('/seniorCetizens/{brgy_id}/update/{id}', [SeniorCetizenController::class, 'update'])->name('senior.update');
    Route::delete('/seniorCetizens/{brgy_id}/destroy/{id}', [SeniorCetizenController::class, 'destroy'])->name('senior.destroy');

    Route::get('/events', [EventsController::class, 'index'])->name('admin.events');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
});

require __DIR__ . '/auth.php';
