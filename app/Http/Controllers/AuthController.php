<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use Config;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;

class AuthController extends Controller
{
    use Helpers;

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      $validator = Validator::make($credentials, [
          'email' => 'required',
          'password' => 'required',
      ]);

      if($validator->fails()) {
          throw new ValidationHttpException($validator->errors()->all());
      }

      try {
          if (! $token = JWTAuth::attempt($credentials)) {
              return $this->response->errorUnauthorized();
          }
      } catch (JWTException $e) {
          return $this->response->error('could_not_create_token', 500);
      }

      return response()->json(compact('token'));

    }

    public function signup(Request $request)
    {
        $signupFields = Config::get('boilerplate.signup_fields');
        $hasToReleaseToken = Config::get('boilerplate.signup_token_release');

        $userData = $request->only($signupFields);

        $validator = Validator::make($userData, Config::get('boilerplate.signup_fields_rules'));

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        User::unguard();
        $user = User::create($userData);
        User::reguard();

        if(!$user->id) {
            return $this->response->error('could_not_create_user', 500);
        }

        if($hasToReleaseToken) {
            return $this->login($request);
        }

        return $this->response->created();
    }

    public function updateUser(Request $request)
    {


      $user = new User;
      
        $user->email = $request->email;
        $user->title = $request->title;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->suffix = $request->suffix;
        $user->streetAddress = $request->streetAddress;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->postalCode = $request->postalCode;
        $user->updated_at = $request->updated_at;

      $user->save();

    }
}
