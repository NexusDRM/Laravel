<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CashierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      // \Braintree_Configuration::environment('sandbox');
      // \Braintree_Configuration::merchantId('px9s23v4b8qsfbk5');
      // \Braintree_Configuration::publicKey('n7pjtmdmbhyzzrhr');
      // \Braintree_Configuration::privateKey('24f776c2c1cda43bb7bfc91ea03d3f4f');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
