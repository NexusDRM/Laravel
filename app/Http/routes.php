<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
// Route::get('/', function () {
//     return view('welcome');
// });

Route::post(
  'braintree/webhook',
  '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

Route::get(
  'getToken',
  '\App\Http\Controllers\TransactionsController@getToken'
);

Route::post(
  'getUser',
  '\App\Http\Controllers\UserController@getUser'
);

Route::post(
  'processPayment',
  '\App\Http\Controllers\TransactionsController@process'
);

Route::post(
  'login',
  '\App\Http\Controllers\AuthController@login'
);

Route::post(
  'signup',
  '\App\Http\Controllers\AuthController@signup'
);

Route::put(
  'updateUser',
  '\App\Http\Controllers\AuthController@updateUser'
);

// Route::post(
//   'getAllUsers',
//   '\App\Http\Controllers\UserController@getAllUsers'
// );
// Route::get('user/invoice/{invoice}', function ($invoiceId) {
//     return Auth::user()->downloadInvoice($invoiceId, [
//         'vendor'  => 'Your Company',
//         'product' => 'Your Product',
//     ]);
// });
