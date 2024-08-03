<?php

namespace Naykel\Pageit;

use Illuminate\Support\ServiceProvider;
use Naykel\Pageit\Commands\InstallCommand;

class PageitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([InstallCommand::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pageit');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
