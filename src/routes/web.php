<?php

use Illuminate\Support\Facades\Route;
use  Jmrashed\DomainSubdomain\Http\Controllers\DomainController;

Route::get('domains', [DomainController::class, 'index'])->name('domains.index');
Route::get('domains/create', [DomainController::class, 'create'])->name('domains.create');
Route::get('domains/edit/{id}', [DomainController::class, 'show'])->name('domains.edit');
Route::get('domains/{id}', [DomainController::class, 'show'])->name('domains.show');
Route::post('domains/store', [DomainController::class, 'store'])->name('domains.store');
Route::post('domains/destroy/{id}', [DomainController::class, 'destroy'])->name('domains.destroy');


// Route::get('/domains', function () {
//     return 'domains.index';
// })->name('domains.index');
