<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
  /**
   * Show a list of all of the application's users.
   *
   * @return Response
   */
  public function getUser(Request $request)
  {
    $results = User::where("id", $request->user_id)->first();

    return response()->json([
      'results'=>$results
    ]);
  }

  

}
