<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MediaSosial;

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
        Schema::defaultStringLength(191);

        View::composer(['landing.*'], function ($view) {
            $view->with('mediaSosial', MediaSosial::where('status_aktif', true)
                ->orderBy('urutan_tampil')
                ->orderBy('nama_platform')
                ->get());
        });
    }
}
