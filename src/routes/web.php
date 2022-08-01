<?php

use Illuminate\Support\Facades\Route;
use  Jmrashed\DomainSubdomain\Http\Controllers\DomainController;

Route::get('/domains', [DomainController::class, 'index'])->name('domains.index');
Route::get('/domains', [DomainController::class, 'create'])->name('domains.create');
Route::get('/domains/{domain}', [DomainController::class, 'show'])->name('domains.show');
Route::post('/domains', [DomainController::class, 'store'])->name('domains.store');
