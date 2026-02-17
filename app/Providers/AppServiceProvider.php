<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // ← Ajoute cette ligne

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191); // ← Ajoute cette ligne

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}