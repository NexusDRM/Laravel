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
      \Braintree_Configuration::environment(env('BT_ENV'));
      \Braintree_Configuration::merchantId(env('BT_MERCHANT_ID'));
      \Braintree_Configuration::publicKey(env('BT_PUBLIC_KEY'));
      \Braintree_Configuration::privateKey(env('BT_PRIVATE_KEY'));
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

    public static function generate() {
      echo(\Braintree_Configuration);
    }
}
