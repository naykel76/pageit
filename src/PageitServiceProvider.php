<?php

namespace Naykel\Pageit;

use Naykel\Pageit\Http\Livewire\PageCreateEdit;
use Illuminate\View\Compilers\BladeCompiler;
use Naykel\Pageit\Http\Livewire\PageTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PageitServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('page-table', PageTable::class);
            Livewire::component('page-create-edit', PageCreateEdit::class);
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pageit');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
