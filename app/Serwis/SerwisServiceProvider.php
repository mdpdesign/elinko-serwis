<?php namespace Serwis;

use Illuminate\Support\ServiceProvider;

class SerwisServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Serwis\Repositories\OrderRepositoryInterface', 'Serwis\Repositories\OrderRepository');
    }

}