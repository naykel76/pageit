<?php

use Naykel\Pageit\Http\Livewire\{PageTable, PageCreateEdit};
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    // Route::get('/page-map', PageMapController::class)->name('page-map');

    Route::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {
        Route::prefix('pages')->name('.pages')->group(function () {
            Route::get('/{page}/edit', PageCreateEdit::class)->name('.edit');
            Route::get('/create', PageCreateEdit::class)->name('.create');
            Route::get('', PageTable::class)->name('.index');
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
