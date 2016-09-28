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
use Illuminate\Support\Facades\DB;
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
      // dd($credentials);
      $validator = Validator::make($credentials, [
          'email' => 'required',
          'password' => 'required',
      ]);
      // dd($validator);
      if($validator->fails()) {
        // dd(1);
          throw new ValidationHttpException($validator->errors()->all());
      }
      try {
          if (! $token = JWTAuth::attempt($credentials)) {
            // dd(2);
            return $this->response->errorUnauthorized();
          }
      }
      catch (JWTException $e) {
        // dd(3);
          return $this->response->error('could_not_create_token', 500);
      }

      // return response()->json(compact('token'));
      return response()->json([
        'token'=>$token
      ]);

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
        return response()->json([
          'token'=>$token
        ]);
        // return $this->response->created();
    }



    public function recovery(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required'
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject(Config::get('boilerplate.recovery_email_subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->response->noContent();
            case Password::INVALID_USER:
                return $this->response->errorNotFound();
        }
    }

    public function reset(Request $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $validator = Validator::make($credentials, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                if(Config::get('boilerplate.reset_token_release')) {
                    return $this->login($request);
                }
                return $this->response->noContent();

            default:
                return $this->response->error('could_not_reset_password', 500);
        }
    }

    public function updateUser(Request $request)
    {
      $user = User::where('id', $request->id)->update([
        'email' => $request->email,
        'title' => $request->title,
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'suffix' => $request->suffix,
        'streetAddress' => $request->streetAddress,
        'city' => $request->city,
        'state' => $request->state,
        'postalCode' => $request->postalCode,
        'phone' => $request->phone,
        'newsletterOptIn' => $request->newsletterOptIn,
      ]);
    }
}
