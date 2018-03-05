<?php

namespace CodeFinances\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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

        #$this->app->bind(
        #    \CodeFinances\Repositories\CategoryRepository::class, 
        #    \CodeFinances\Repositories\CategoryRepositoryEloquent::class);

        $this->app->bind(
            \CodeFinances\Repositories\CategoryRevenueRepository::class, 
            \CodeFinances\Repositories\CategoryRevenueRepositoryEloquent::class);

        $this->app->bind(
            \CodeFinances\Repositories\CategoryExpenseRepository::class, 
            \CodeFinances\Repositories\CategoryExpenseRepositoryEloquent::class);
        
        $this->app->bind(
            \CodeFinances\Repositories\BillPayRepository::class, 
            \CodeFinances\Repositories\BillPayRepositoryEloquent::class);
        
        //:end-bindings:

    }
}
