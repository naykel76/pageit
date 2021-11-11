<?php

namespace Naykel\Pageit;

use Illuminate\Support\ServiceProvider;
use Naykel\Pageit\Components\Toolbar;

class PageitServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pageit');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        $this->loadViewComponentsAs('pageit', [
            Toolbar::class,
        ]);
    }
}
