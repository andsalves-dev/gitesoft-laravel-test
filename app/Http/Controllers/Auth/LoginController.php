<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller {
    use AuthenticatesUsers;

    /** @var string */
    protected $redirectTo = '/';

    public function index() {
        if (Auth::check()) {
            return redirect()->route('films.list');
        }

        return view('frontend/auth/login');
    }

    public function authenticate() {
        $postData = request()->post();

        $validator = Validator::make($postData, [
            'username' => ['required', 'regex:/^[0-9a-zA-Z-_\.\@]+$/'],
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            /** @var MessageBag $messageBag */
            $messageBag = $validator->errors();
            return redirect()->route('auth.login')->with('error_message', $messageBag->getMessageBag()->first());
        }

        $userField = strstr($postData['username'], '@') ? 'email' : 'username';

        $authenticated = Auth::attempt([
            $userField => $postData['username'],
            'password' => $postData['password'],
            'status' => 'active'
        ]);

        if ($authenticated) {
            return redirect()->intended('films');
        } else {
            return redirect()->route('auth.login')->with('error_message', 'Credentials are invalid');
        }
    }
}
