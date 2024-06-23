<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Models\Document_Kerjasama_Client;
use App\Observers\DocumentKerjasamaClientObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Document_Kerjasama_Client::observe(DocumentKerjasamaClientObserver::class);
        Paginator::useBootstrap();
    }
}
