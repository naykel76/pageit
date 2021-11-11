<?php

use Illuminate\Support\Facades\Route;
use Naykel\Pageit\Controllers\PageController;

Route::middleware(['web'])->group(function () {

    // admin routes
    Route::middleware(['auth', 'role:super|admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('/pages', PageController::class)->except(['show']);
    });

});


