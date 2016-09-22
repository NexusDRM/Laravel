<?php

$api = app('Dingo\Api\Routing\Router');




$api->version('v1', function ($api) {

	$api->group(['middleware' => 'cors'], function($api) {
		$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
		$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
		$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
		$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');
		$api->get('transactions', 'App\Api\V1\Controllers\TransactionController@index');
		$api->get('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@show');
		$api->post('transactions', 'App\Api\V1\Controllers\TransactionController@store');
		$api->put('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@update');
		$api->delete('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@destroy');
	});


	// $api->post('protected',['middleware' => ['api.auth'], function(){
	// 	return \App\Transaction();
	// }]);
	// $api->get('transactions/getToken', ['middleware' => ['cors'], function(){
	// 	  echo(\Braintree_Configuration);
	// }]);




	// example of protected route
	// $api->get('protected', ['middleware' => ['api.auth'], function () {
	// 	return \App\User::all();
  //   }]);

	// example of free route
	// $api->get('free', function() {
	// 	return \App\User::all();
	// });

	// $api->group(['middleware' => ['cors']], function ($api){
		// $api->get('transactions', 'App\Api\V1\Controllers\TransactionController@index');
		// $api->get('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@show');
		// $api->post('transactions', 'App\Api\V1\Controllers\TransactionController@store');
		// $api->put('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@update');
		// $api->delete('transactions/{id}', 'App\Api\V1\Controllers\TransactionController@destroy');
		// $api->get('transactions/getToken', 'App\Api\V1\Controllers\TransactionController@getToken');
	// });

});
