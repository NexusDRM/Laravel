<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use JWTAuth;
use App\Transactions;
use Dingo\Api\Routing\Helpers;
use Braintree;
use \Braintree_ClientToken;
use \Braintree_Transaction;

class TransactionsController extends Controller
{
  public function createToken()
  {
    $clientToken = \Braintree\ClientToken::generate();
    return $clientToken;
  }
// $cse = array("MIIBCgKCAQEAyDq6BZxgtNLrXSuLW82Atwd839+iKqVEfM3lMzyD/F6oQaJ3zXruMdBUld1sbvLl56xhzwCPx1mL+0c0NcQMIQViSWXXP8/rP23zPZGsuNZXxRwGaOUG205QhpseZz+oli0Fgrj91F0vw2ftO/6TOOWfrEhHxPjThiSRF34OCnAuo/dppPmU94X30U4KK715Mol6DCusXFWgAlGVAuoZUjJ03SwNMMXh4KLyp46XBe6/nfWF6nSkkxIO5YCoOWBDQfY3HYvUlxu6OFRu7jk8N0stMc5/omQ44Gi8dW+FpUMkJ+c3vDdUykaR21n/xAtNKVNiHeriSG7w3Q9f88r/LQIDAQAB");
  public function getToken(Request $request)
  {
    $clientToken = Braintree_ClientToken::generate();

    return response()->json([
      'clientToken'=>$clientToken
    ]);
  }

  public function process(Request $request)
  {
    $nonceFromTheClient = $request->payload;
    $amountFromClient = $request->amount;
    $result = Braintree_Transaction::sale([
      'amount' => $amountFromClient,
      'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [
        'submitForSettlement' => True
        ]
    ]);
    return($result);
  }
}
