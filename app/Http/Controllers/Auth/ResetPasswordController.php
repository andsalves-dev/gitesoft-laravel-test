<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller {

    use ResetsPasswords;

    /** @var string */
    protected $redirectTo = '/';

    protected function guard() {
        return Auth::guard('user-guard');
    }
}
