<?php namespace Serwis;

use Illuminate\Support\ServiceProvider;
use Serwis\Helpers\SerwisHelper;

class SerwisServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

		// Rejestracja i powiazanie Interfejsow z Klasami
        $app->bind('Serwis\Repositories\OrderRepositoryInterface', 'Serwis\Repositories\OrderRepository');
		$app->bind('Serwis\Repositories\UserRepositoryInterface', 'Serwis\Repositories\UserRepository');
		
		// Rejestracja funkcji pomocniczych dla aplikacji
		$app->singleton('SerwisHelper', function()
        {
            return new SerwisHelper;
        });
    }

}