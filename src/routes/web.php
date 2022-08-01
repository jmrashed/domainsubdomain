<?php

use Illuminate\Support\Facades\Route;
use  Jmrashed\DomainSubdomain\Http\Controllers\DomainsController;

Route::get('/domains', [DomainsController::class, 'index']);
Route::get('/domains/{domain}', [DomainsController::class, 'show']);
Route::post('/domains', [DomainsController::class, 'store']);
