<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // Disponibiliza o nome da view pro blade, para ser usado pelo menu
        view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('current_view', $view_name);
        });
    }
}
