<?php

namespace CodeFinances\Providers;

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
        #\DB::listen(function ($query){
        #    echo $query->sql;
        #});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerManager()
    {
        $this->app->singleton('tymon.jwt.manager', function($app){
            $instance = new Manager(
                $app['tymon.jwt.provider.jwt'],
                $app['tymon.jwt.blacklist'],
                $app['tymon.jwt.payload.factory']
            );
            return $instance->setBlacklistEnabled((bool) config('jwt.blacklist_enabled'));
        });
    }
}
