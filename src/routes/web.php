<?php

use Illuminate\Support\Facades\Route;
use  Jmrashed\DomainSubdomain\Http\Controllers\DomainController;

Route::get('/domains', [DomainController::class, 'index']);
Route::get('/domains/{domain}', [DomainController::class, 'show']);
Route::post('/domains', [DomainController::class, 'store']);
