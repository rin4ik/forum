<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
            $view->with('channels', Channel::all());
        });
        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
        $this->app->singleton(Illuminate\Support\EngineManager::class, function ($app) {
            return new \Laravel\Scout\EngineManager($app);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
