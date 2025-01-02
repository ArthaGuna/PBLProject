<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;  

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Menambahkan hook untuk mengganti halaman login Filament
        Filament::serving(function () {
            Filament::registerRenderHook(
                'login-page.start',
                fn() => view('auth.login') // view custom untuk login
            );
        });
    }
}
