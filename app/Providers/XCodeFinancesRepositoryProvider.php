<?php

namespace CodeFinances\Providers;

use Illuminate\Support\ServiceProvider;

class CodeFinancesRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \CodeFinances\Repositories\BankRepository::class, 
            \CodeFinances\Repositories\BankRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeFinances\Repositories\BankAccountRepository::class, 
            \CodeFinances\Repositories\BankAccountRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeFinances\Repositories\ClientRepository::class, 
            \CodeFinances\Repositories\ClientRepositoryEloquent::class);

        $this->app->bind(
            \CodeFinances\Repositories\CategoryRepository::class, 
            \CodeFinances\Repositories\CategoryRepositoryEloquent::class);
        //:end-bindings:
    }
}
