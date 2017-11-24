<?php

namespace App\Http\Controllers\Auth;

use App\Http\Helper\UsersCrudHelper;
use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller {

    public function index() {
        if (Auth::check()) {
            return redirect()->route('films.list');
        }

        return view('frontend/register/index')->with('values', Input::old());
    }

    public function save() {
        $postData = request()->post();

        /** @var MessageBag $messageBag */
        if (!UsersCrudHelper::validatePostData($postData, $messageBag)) {
            return redirect()->route('register')
                ->withInput($postData)
                ->with('error_message', $messageBag->first());
        }

        try {
            $film = new User();
            $film->fill(array_merge($postData, [
                'password' => password_hash($postData['password'], PASSWORD_DEFAULT)
            ]));
            $film->save();

            return redirect()->route('auth.login')->with('success_message', 'User registered successfully! Now you can perform your login');
        } catch (\Exception $exception) {
            return redirect()->route('register')
                ->withInput($postData)
                ->with('error_message', $exception->getMessage());
        }
    }
}
