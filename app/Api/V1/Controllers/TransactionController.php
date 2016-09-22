<?php

namespace App\Api\V1\Controllers;


use JWTAuth;
use App\Transactions;
use Dingo\Api\Routing\Helpers;
use App\Providers\CashierServiceProvider as Cashier;


class TransactionController extends Controller {
	use Helpers;

	public function index(){
		$currentUser = JWTAuth::parseToken()->authenticate();
		return $currentUser
			->books()
			->orderBy('created_at', 'DESC')
			->get()
			->toArray();
	}

	public function store(Request $Request){
		$currentUser = JWTAuth::parseToken()->authenticate();
		$transaction = new Transaction;

		$transaction->trans_amount = $request->get('trans_amount');
		$transaction->user_id = $request->get('user_id');
		$transaction->stripe_trans_id = $request->get('stripe_trans_id');
		$transaction->currency_id = $request->get('currency_id');
		$transaction->created_at = $request->get('created_at');
	}

	public function show($id){
		$currentUser = JWTAuth::parseToken()->authenticate();
		$transaction = $currentUser->transactions()->find('id');
		if(!transaction){
			throw new NotFoundHttpException;
		}
		return transaction;
	}

	public function update(Request $Request, $id){
		$currentUser = JWTAuth::parseToken()->authenticate();
		$transaction = $currentUser->transactions()->find('id');

		if(!transaction){
			throw new NotFoundHttpException;
		}

		$transaction->fill($request->all());

		if($transaction->save()){
			return $this->response->noContent();
		} else {
			return $this->response->error('could_not_update_transaction', 500);
		}
	}

	public function destroy(Request $Request, $id){
		$currentUser = JWTAuth::parseToken()->authenticate();
		$transaction = $currentUser->transactions()->find('id');

		if(!$transaction){
			throw new NotFoundHttpException;
		}

		if($transaction->delete()){
			return $this->response->noContent();
		} else {
			return $this->response->error('could_not_delete_transaction', 500);
		}
	}

	// public function createToken()
	// {
	// 	$clientToken = Cashier\ClientToken::generate();
	// 	return $clientToken;
	// }

	public function getToken(Request $request)
	{
		// dd(Cashier::generate());

		// $data = createToken();


		//return response()->json(compact('clientToken'));

		// return response()->json(compact('client_token'));

			// return $this->response([
			//     'client_token' => \Braintree\ClientToken::generate(),
			// ]);

	}
}
