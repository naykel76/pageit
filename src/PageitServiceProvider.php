<?php

namespace Naykel\Pageit;

use Naykel\Pageit\Http\Livewire\PageCreateEdit;
use Illuminate\View\Compilers\BladeCompiler;
use Naykel\Pageit\Http\Livewire\PageTable;
use Naykel\Pageit\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PageitServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('page-create-edit', PageCreateEdit::class);
            Livewire::component('page-table', PageTable::class);
        });
    }

    public function boot()
    {
        $this->commands([InstallCommand::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pageit');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
