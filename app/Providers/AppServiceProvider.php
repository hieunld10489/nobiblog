<?php

namespace App\Providers;

use App\Http\AppUrlGenerator;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $url = $this->app['url'];
        $this->app->singleton('url', function () use ($url) {
            return new AppUrlGenerator($url);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->isSecure()) {
            \URL::forceScheme('https');
        }

        app('view')->composer('layouts.app', function ($view) {
            $action = app('request')->route()->getAction();
            $routeAs = $action['as'];

            $view->with(compact('routeAs'));
        });
    }
}
