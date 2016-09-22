<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use JWTAuth;
use App\Transactions;
use Dingo\Api\Routing\Helpers;
use Braintree;
use \Braintree_ClientToken;

class TransactionsController extends Controller
{
  public function createToken()
  {
    $clientToken = \Braintree\ClientToken::generate();
    return $clientToken;
  }

  public function getToken(Request $request)
  {
    $clientToken = Braintree_ClientToken::generate();
    return response()->json([
      'clientToken'=>$clientToken
    ]);
  }
  public function process(Request $request)
  {
    //
  }
}
