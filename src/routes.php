<?php

use Naykel\Pageit\Http\Livewire\{PageTable, PageCreateEdit, PageBuilder};
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    // Route::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {
    Route::prefix('admin')->name('admin')->group(function () {

        Route::prefix('pages')->name('.pages')->group(function () {
            Route::get('/{page:slug}/edit', PageCreateEdit::class)->name('.edit');
            Route::get('/create', PageCreateEdit::class)->name('.create');
            Route::get('', PageTable::class)->name('.index');
        });

        Route::prefix('page-builder')->name('.page-builder')->group(function () {
            Route::get('/{page:slug}/edit', PageBuilder::class)->name('.edit');
            Route::get('/create', PageBuilder::class)->name('.create');
        });

    });
});


/** ---------------------------------------------------------------------------
 *  =!= MUST RUN LAST =!= MUST RUN LAST =!= MUST RUN LAST =!= MUST RUN LAST =!=
 * ------------------------------------------------------------------------- */
///////////////////////////////////////////////////////////////////////////////
// Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
///////////////////////////////////////////////////////////////////////////////
/** ---------------------------------------------------------------------------
 *  =!= MUST RUN LAST =!= MUST RUN LAST =!= MUST RUN LAST =!= MUST RUN LAST =!=
 * ------------------------------------------------------------------------- */
