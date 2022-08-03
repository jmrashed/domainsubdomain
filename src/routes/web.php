<?php

use Illuminate\Support\Facades\Route;
use  Jmrashed\DomainSubdomain\Http\Controllers\DomainController;
use Jmrashed\DomainSubdomain\Http\Controllers\SubDomainController;

Route::get('domains', [DomainController::class, 'index'])->name('domains.index');
Route::get('domains/create', [DomainController::class, 'create'])->name('domains.create');
Route::get('domains/edit/{id}', [DomainController::class, 'show'])->name('domains.edit');
Route::get('domains/{id}', [DomainController::class, 'show'])->name('domains.show');
Route::post('domains/store', [DomainController::class, 'store'])->name('domains.store');
Route::post('domains/destroy/{id}', [DomainController::class, 'destroy'])->name('domains.destroy');


Route::get('domains/export/{id}', [DomainController::class, 'export'])->name('domains.export');
Route::get('domains/import/{id}', [DomainController::class, 'import'])->name('domains.import');



// subdomains

Route::get('subdomains', [SubDomainController::class, 'index'])->name('subdomains.index'); 
Route::get('subdomains/create', [SubDomainController::class, 'create'])->name('subdomains.create');
Route::get('subdomains/export/{id}', [SubDomainController::class, 'export'])->name('subdomains.export');
Route::get('subdomains/import/{id}', [SubDomainController::class, 'import'])->name('subdomains.import');


//options
Route::get('/login', function () {
    return 'domains.index';
})->name('domains.index');
